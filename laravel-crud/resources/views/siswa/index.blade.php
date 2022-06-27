@extends('layouts.master')

@section('content')

@if(session('success'))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif
<div class="row">
    <div class="col-6">
        <h1>Data Siswa</h1>
    </div>
    <div class="col-6">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/siswa/create" method="POST">
                            {{csrf_field()}}
                            <div class="mb-3">
                                <label for="nama_depan" class="form-label">Nama Depan</label>
                                <input type="text" class="form-control" id="nama_depan" aria-describedby="emailHelp" name="nama_depan">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_belakang">
                            </div>

                            <select class="form-select mb-3" aria-label="Default select example" name="jenis_kelamin">
                                <option selected>Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Agama</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="agama">
                            </div>

                            <div class=" mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="alamat"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">NAMA DEPAN</th>
            <th scope="col">NAMA BELAKANG</th>
            <th scope="col">JENIS KELAMIN</th>
            <th scope="col">AGAMA</th>
            <th scope="col">ALAMAT</th>
            <th scope="col">AKSI</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_siswa as $siswa)
        <tr>
            <td>{{$siswa->nama_depan}}</td>
            <td>{{$siswa->nama_belakang}}</td>
            <td>{{$siswa->jenis_kelamin}}</td>
            <td>{{$siswa->agama}}</td>
            <td>{{$siswa->alamat}}</td>
            <td><a class="btn btn-warning btn-sm" href="/siswa/{{$siswa->id}}/edit" role="button">Edit</a>
                <a class="btn btn-danger btn-sm" href="/siswa/{{$siswa->id}}/delete" role="button" onclick="return confirm('Are You Sure?')">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection