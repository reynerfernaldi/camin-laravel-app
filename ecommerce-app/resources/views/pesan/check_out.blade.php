@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Check Out Pesanan</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mb-3">
            <a href="{{url('home')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Check Out</h2>
                    @if(!empty($pesanan))
                    <p align="right">Tanggal Pesanan: {{$pesanan->tanggal}}</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pesanan_detail as $detail_pesanan)
                            <tr>
                                <td class="align-middle">{{$no++}}</td>
                                <?php
                                $barang = App\Models\Barang::where('id', $detail_pesanan->barang_id)->first();
                                ?>
                                <td class="align-middle">
                                    <img src="{{url('img')}}/{{$barang->gambar}}" alt="gambar" width="100">
                                </td>
                                <td class="align-middle">{{$barang->nama_barang}}</td>
                                <td class="align-middle">{{$detail_pesanan->jumlah}}</td>
                                <td class="align-middle">Rp {{number_format($barang->harga)}}</td>
                                <td class="align-middle">Rp {{number_format($detail_pesanan->jumlah_harga)}}</td>
                                <td class="align-middle">
                                    <form action="{{url('check-out')}}/{{$detail_pesanan->id}}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapis data?');"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                            <tr class="table-active">
                                <td colspan="5" align="right" class="align-middle"> <strong>Total Harga</strong> </td>
                                <td class="align-middle"><strong>Rp {{number_format($pesanan->jumlah_harga)}}</strong></td>
                                <td>
                                    <a href="{{url('konfirmasi-check-out')}}" class="btn btn-success" onclick="return confirm('Anda yakin akan Checkout?');">
                                        Checkout
                                    </a>
                                </td>

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