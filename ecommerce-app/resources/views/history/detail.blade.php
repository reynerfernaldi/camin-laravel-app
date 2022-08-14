@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('history')}}">History</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mb-3">
            <a href="{{url('history')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Sukses Check Out</h3>
                    <h5>Pesanan anda telah sukses di checkout. Selanjutnya untuk pembayaran, solahkan transfer di rekening <br><strong>Bank BCA <br>No Rekening: 12345</strong> dengan nominal <strong>Rp {{number_format($pesanan->kode + $pesanan->jumlah_harga) }}</strong></h5>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Detail Pesanan</h2>
                    @if(!empty($pesanan))
                    <p align="right">Tanggal Pesanan: {{$pesanan->tanggal}}</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pesanan_details as $detail_pesanan)
                            <tr>
                                <td>{{$no++}}</th>
                                    <?php
                                    $barang = App\Models\Barang::where('id', $detail_pesanan->barang_id)->first();
                                    ?>
                                <td>{{$barang->nama_barang}}</td>
                                <td>{{$detail_pesanan->jumlah}}</td>
                                <td>Rp {{number_format($barang->harga)}}</td>
                                <td>Rp {{number_format($detail_pesanan->jumlah_harga)}}</td>
                            </tr>
                            @endforeach
                            <tr class="table-active">
                                <td colspan="4" align="right"> <strong>Total Harga</strong> </td>
                                <td><strong>Rp {{number_format($pesanan->jumlah_harga)}}</strong></td>
                            </tr>
                            <tr class="table-active">
                                <td colspan="4" align="right"> <strong>Kode Unik</strong> </td>
                                <td><strong>{{$pesanan->kode}}</strong></td>
                            </tr>
                            <tr class="table-active">
                                <td colspan="4" align="right"> <strong>Total Bayar</strong> </td>
                                <td><strong>Rp {{number_format($pesanan->kode + $pesanan->jumlah_harga) }}</strong></td>
                            </tr>

                        </tbody>
                    </table>
                    @endif
                </div>
            </div>

        </div>


    </div>



</div>
@endsection