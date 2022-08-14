@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History Pemesanan</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mb-3">
            <a href="{{url('home')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>History Pemesanan</h2>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jumlah Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pesanans as $pesanan)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$pesanan->tanggal}}</td>
                                <td>Rp {{number_format($pesanan->jumlah_harga + $pesanan->kode)}}</td>
                                <td>
                                    @if($pesanan->status == 1)
                                    Belum dibayar
                                    @else
                                    Sudah dibayar
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('history')}}/{{$pesanan->id}}" class="btn btn-success">
                                        <i class="fa fa-info"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>



</div>
@endsection