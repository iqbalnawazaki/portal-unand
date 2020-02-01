@extends('layouts.mahasiswa')

@section('content')
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h5>Selamat Datang <b>{{ Auth::user()->name }}</b> di Portal Akademik Universitas Andalas</h5>
    </div>
  </div>
</div>
@foreach ($postingans as $postingan)

<div class="col-md-4">
  <div class="card card-outline-success">
    <div class="card-header">
      <h4 class="m-b-0 text-white">Pengumuman</h4></div>
      <div class="card-body">
        <h5 class="card-title">{{$postingan->judul}}</h5>
        <h5 class="card-text text-right"><small class="text-muted">Posted by {{App\User::find($postingan->user_id)->name }}</small></h5>
        <h5 class="card-text text-right"><small class="text-muted">{{$postingan->waktu}}</small></h5>
        <a href="{{ url('/posting/' . $postingan->id) }}" class="btn btn-rounded btn-success">View</a>
      </div>
    </div>
  </div>
@endforeach
@endsection
