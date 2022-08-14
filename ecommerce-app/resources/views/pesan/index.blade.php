@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesan</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mb-3">
            <a href="{{url('home')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{$barang->nama_barang}}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{url('img')}}/{{$barang->gambar}}" alt="gambar batik" width="100%" class="rounded mx-auto d-block">
                        </div>

                        <div class="col-md-6 mt-5">
                            <h4>{{$barang->nama_barang}}</h4>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>Rp {{number_format($barang->harga)}}</td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td>:</td>
                                    <td>{{$barang->stok}}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td>{{$barang->keterangan}}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pesan</td>
                                    <td>:</td>
                                    <td>
                                        <form action="{{url('pesan')}}/{{$barang->id}}" method="post">
                                            @csrf
                                            <input type="text" name="jumlah_pesan" class="form-control" required value="1">
                                            <button type="submit" class="btn btn-primary mt-3"> <i class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>




                    </div>

                </div>
            </div>
        </div>
    </div>



</div>
@endsection