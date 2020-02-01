@extends('layouts.mahasiswa')

@section('content')
<div class="container">
  
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> Selamat, Foto Profil Anda Telah Diganti <i class="mdi mdi-emoticon-cool"></i>
      </div>
    @endif

    @if (count($errors) > 0)
    <div class="card-danger">
    <div class="alert alert-danger"> <i class="ti-user"></i>
      <strong>Whoops!</strong> Ada beberapa masalah dengan masukan Anda..<br><br>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      <br>
    </div>
    </div>
    @endif

  <div class="card ">
    <div class="card-body">
      <h5><i class="mdi mdi-account"></i> Profil</h5>
    </div>
  </div>
  <!-- Row -->
  <div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
      <div class="card">
        <div class="row justify-content-center">
          <div class="card-body">
            <center class="m-t-30">
              <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1"> <img src="{{  asset('storage/avatars/'.$user->avatar) }}" alt="user" style="width:150px; height:200px;" />
                </div>
                <div class="el-card-content">
                  <small></small>
                  <br/> </div>
                </div>
              </center>
            </div>
          </div>
          <div><hr></div>
          <div class="card-body">
            <center class="m-t-30">
              <small class="text-muted">Nama </small><h6>{{ $user->name }}</h6>
              <small class="text-muted">NIM </small><h6>{{ $user->id }}</h6>
              <small class="text-muted">Email address </small><h6>{{ $user->email }}</h6>
              <small class="text-muted">Jurusan</small><h6>{{ $user->detail->jenjang }} {{ $user->detail->jurusan }}</h6>
                <br/><br/>
                <small class="text-muted p-t-30 db">Social Profile</small>
                <br/>
                <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>
              </center>
            </div>
          </div>
        </div>

        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
          <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Data Diri</a> </li>
              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="home" role="tabpanel">
                <div class="card-body">
                  <div class="row">
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                          <tr><th> No BP </th><td>{{ $user->detail->nim }} </td></tr>
                          <tr><th> Alamat </th><td>{{ $user->detail->alamat }} </td></tr>
                          <tr><th> Tempat Tanggal Lahir</th><td> {{ $user->detail->kotalahir }}, {{ date('d F Y', strtotime($user->detail->tglahir)) }} </td></tr>
                          <tr><th> Agama </th><td> {{ $user->detail->agama }} </td></tr>
                          <tr><th> Jenis Kelamin</th><td>
                            @if($user->detail->jenis_kelamin =="L")
                                  Laki-laki
                            @else
                                  Perempuan
                            @endif
                            </td></tr>
                          <tr><th> Asal SLTA</th><td> {{ $user->detail->asalsma }} </td></tr>
                          <tr><th> Tanggal Terdaftar</th><td> {{ date('d F Y', strtotime($user->detail->tglterdaftar)) }} </td></tr>
                          <tr><th> Nama Orangtua </th><td> {{ $user->detail->namaayah }} </td></tr>
                          <tr><th> Alamat Orangtua</th><td> {{ $user->detail->alamatortu }} </td></tr>
                          <tr><th> Warga Negara</th><td> {{ $user->detail->negara }} </td></tr>
                          <tr><th> Status</th><td> {{ $user->detail->status }} </td></tr>
                          <tr><th> Level/Jalur Masuk</th><td> {{ $user->detail->jalurmasuk }} </td></tr>
                          <tr><th> Besar Uang Kuliah</th><td> - </td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!--second tab-->

              <div class="tab-pane" id="settings" role="tabpanel">
                <div class="card-body">
                  <h5 class="text-megna"><b>Ubah Foto Profil</b></h5><br>
                  <form action="{{ url('/profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Please upload size 3x4 and under 1MB.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                 
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>


  </div>
@endsection
