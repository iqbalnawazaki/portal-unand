@extends('layouts.mahasiswa')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-body">
                    <h5><i class="mdi mdi-account"></i> Form Ubah Password</h5>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="floating-labels" method="POST" action="{{ route('changePassword') }}">
                            {{ csrf_field() }}
                            <br>
                            <div class="form-group {{ $errors->has('current-password') ? ' has-error' : '' }}">
                                
                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>
                                    <span class="bar"></span>
                                    <label for="current-password">Password lama</label>
                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                
                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control" name="new-password" required>
                                    <span class="bar"></span>
                                    <label for="new-password">Password baru</label>
                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                               
                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                    <span class="bar"></span>
                                    <label for="new-password-confirm">Tulis Ulang Password baru</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Ubah Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection