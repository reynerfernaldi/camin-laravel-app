@extends('layouts.master')

@section('content')

<div class="container">
    <div class="jumbotron p-5 rounded-3" style="background-color:#DFF6FF">
        <h1 class="display-4">Welcome!</h1>
        <p class="lead">Selamat datang admin MCI!</p>
        <hr class="my-4">
        <p>Seilahkan klik "Masuk" untuk menambahkan atau mengubah data siswa </p>
        <a class="btn btn-primary btn-lg" href="/siswa" role="button">Masuk</a>
    </div>
</div>
@endsection