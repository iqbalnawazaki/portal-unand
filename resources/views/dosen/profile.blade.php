  @extends('layouts.dosen')

  @section('content')
  <div class="container">
    <div class="row">
      @if ($message = Session::get('success'))

      <div class="alert alert-success alert-block">

        <button type="button" class="close" data-dismiss="alert">×</button>

        <strong>{{ $message }}</strong>

      </div>

      @endif

      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>
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
                <small class="text-muted">Email address </small><h6>{{ $user->email }}</h6>
                <small class="text-muted">Status</small>
                <h6>@foreach ($user->roles()->pluck('name') as $role)
                  <h6>{{ $role }}</h6>
                  @endforeach</h6>
                  <br/>
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
                            @foreach($user->detail as $dosen)
                            <tr><th> NIP </th><td>{{ $dosen->nip }} </td></tr>
                            <tr><th> Alamat </th><td> {{ $dosen->alamat }} </td></tr>
                            <tr><th> Tempat Tanggal Lahir</th><td> {{ $dosen->kota_lahir }}, {{ $dosen->tgl_lahir }} </td></tr>
                            <tr><th> Agama </th><td> {{ $dosen->agama }} </td></tr>
                            <tr><th> Jenis Kelamin</th><td> 
                            @if($dosen->jenis_kelamin == "L")
                            Laki-laki
                            @else
                            Perempuan
                            @endif
                            </td></tr>
                            <tr><th> Telp. Kantor</th><td> {{ $dosen->telp_kantor }} </td></tr>
                            <tr><th> Telp. Selular</th><td> {{ $dosen->no_hp }} </td></tr>
                            <tr><th> Telp. Rumah </th><td> {{ $dosen->telp_rumah }} </td></tr>
                            <tr><th> Kewarganegaraan</th><td> {{ $dosen->negara }} </td></tr>
                            
                            @endforeach
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--second tab-->

                <div class="tab-pane" id="settings" role="tabpanel">
                <p class="text-center"><span style="font-size:14px; background:3a9679;" class="badge badge-info">Masukkan Foto Profil</span></p>
                  <div class="card-body">
                    <form action="{{ url('/profile')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Please upload size 3x4 and under 1MB.</small>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                  <hr>
                  <p class="text-center"><span style="font-size:14px; background:3a9679;" class="badge badge-info">Masukkan Tanda Tangan</span></p>
                  <div class="card col-lg-4 container">
                      <p class="text-center"><img class="pull-center" src="{{  asset('storage/signature/'.$user->signature) }}" alt="user" style="width:90px; height:90px;" /></p>
                   </div>
                 <div class="card-body">
                    <form action="{{ url('/signature')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <input type="file" class="form-control-file" name="signature" id="signatureFile" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Please upload file png and under 1MB.</small>
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
