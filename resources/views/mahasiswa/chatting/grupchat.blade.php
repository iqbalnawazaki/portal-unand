@extends('layouts.mahasiswa')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script> 

@section('content')
<div class="col-lg-12">
    <div class="card ">
        <div class="card-body">
            <h5><i class="mdi mdi-account-multiple"></i> Bimbingan Akademik
            <a href="{{ url('/chatting') }}" class="pull-right btn btn-rounded btn-success">
            <i class="mdi mdi-message-text" aria-hidden="true"></i> Chat
            </a>
            </h5>
        </div>
    </div>

    <div class="card" id="app" >
       
            <grup-app  :user="{{ auth()->user() }}"></grup-app>
        
    </div>

</div>
@endsection
