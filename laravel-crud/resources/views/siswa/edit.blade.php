@extends('layouts.master')

@section('content')

<h1>Edit</h1>
@if(session('success'))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif
<form action="/siswa/{{$siswa->id}}/update" method="POST">
    {{csrf_field()}}
    <div class="mb-3">
        <label for="nama_depan" class="form-label">Nama Depan</label>
        <input type="text" class="form-control" id="nama_depan" aria-describedby="emailHelp" name="nama_depan" value="{{$siswa->nama_depan}}">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_belakang" value="{{$siswa->nama_belakang}}">
    </div>
    <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
            <option value="Laki-Laki" @if($siswa->jenis_kelamin == 'Laki-Laki') selected @endif >Laki-Laki</option>
            <option value="Perempuan" @if($siswa->jenis_kelamin == 'Perempuan') selected @endif >Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Agama</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="agama" value="{{$siswa->agama}}">
    </div>

    <div class=" mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="alamat">{{$siswa->alamat}}</textarea>
    </div>
    <a class="btn btn-danger" href="/siswa" role="button">Batalkan</a>
    <button type="submit" class="btn btn-warning">Update</button>

</form>

@endsection