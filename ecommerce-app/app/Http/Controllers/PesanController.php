<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $barang = Barang::where('id', $id)->first();

        return view('pesan.index', compact('barang'));
    }

    public function pesan(Request $request, $id)
    {
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        // validasi apoakah melebihi stok
        if ($request->jumlah_pesan > $barang->stok) {
            toast('Maaf, stok tidak mencukupi', 'error');
            return redirect('pesan/' . $id);
        }

        if ($request->jumlah_pesan == 0) {
            toast('Maaf, minimal pembelian 1 item', 'error');
            return redirect('pesan/' . $id);
        }


        // cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (empty($cek_pesanan)) {
            //simpan ke database pesanan
            $pesanan = new Pesanan;

            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
        }


        //simpan ke database pesanan detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //cek pesan detail
        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();

        if (empty($cek_pesanan_detail)) {
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->save();
        } else {
            $pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
            //harga sementara
            $harga_sementara = $barang->harga * $request->jumlah_pesan;

            $pesanan_detail->jumlah = $request->jumlah_pesan + $pesanan_detail->jumlah;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_sementara;
            $pesanan_detail->update();
        }

        //Jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $barang->harga * $request->jumlah_pesan;
        $pesanan->update();

        Alert::success('Sukses', 'Barang Telah masuk ke keranjang');
        return redirect('home');
    }

    public function check_out()
    {

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (!empty($pesanan)) {
            $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            return view('pesan.check_out', compact('pesanan', 'pesanan_detail'));
        }

        return view('pesan.check_out', compact('pesanan'));
    }

    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();
        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();

        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        Alert::error('Pesanan Sukses Dihapus', 'Hapus');
        return redirect('check-out');
    }

    public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (empty($user->alamat)) {
            Alert::error('Gagal', 'Silahkan lengkapi alamat');
            return redirect('profile');
        } else if (empty($user->nohp)) {
            Alert::error('Gagal', 'Silahkan lengkapi nomor hp');
            return redirect('profile');
        }
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan_id)->get();

        foreach ($pesanan_detail as $detail_pesanan) {
            $barang = Barang::where('id', $detail_pesanan->barang_id)->first();
            $barang->stok = $barang->stok - $detail_pesanan->jumlah;
            $barang->update();
        }

        Alert::success('Sukses', 'Barang Telah di Check Out. Silahkan lanjut ke pembayaran');

        return redirect('history/' . $pesanan_id);
    }
}
