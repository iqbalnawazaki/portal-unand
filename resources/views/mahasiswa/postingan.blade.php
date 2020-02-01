@extends('layouts.mahasiswa')

@section('content')
<div class="col-md-12">
  <div class="card card-outline-success">
    <div class="card-header">
      <h4 class="m-b-0 text-white">Pengumuman</h4></div>
      <div class="card-body">
        <h3 class="card-title">{{$postingan->judul}}</h3>
        <p class="card-text">{!!$postingan->konten!!}</p>
        <h5 class="card-text text-right"><small class="text-muted">Posted by {{App\User::find($postingan->user_id)->name }}</small></h5>
        <h5 class="card-text text-right"><small class="text-muted">{{$postingan->waktu}}</small></h5>
        <a href="{{ url('/')}}" class="btn btn-rounded btn-primary">Kembali</a>
      </div>
    </div>
  </div>
@endsection
