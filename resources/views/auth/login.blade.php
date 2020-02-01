@extends('layouts.login')

@section('content')
<div class="container">
  
  <form method="POST" class="form-horizontal form-material" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
    @csrf
    <div class="form-group m-t-40">
    

      <div class="col-xs-12">
        <input id="id" type="text" placeholder="NIM/NIP" class="form-control{{ $errors->has('email') || $errors->has('id') ? ' is-invalid' : '' }}" name="id" value="{{ old('id') }}" required autofocus>

        @if ($errors->has('id'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('id') }}</strong>
        </span>
        @endif
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif

      </div>
    </div>

    <div class="form-group">
      <div class="col-xs-12">
        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-6 offset-md-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        </div>
      </div>
    </div>

    <div class="form-group text-center m-t-20">
      <div class="col-xs-12">
        <button type="submit" class="btn btn-success btn-lg btn-block text-uppercase waves-effect waves-light">
          {{ __('Login') }}
        </button>

      </div>
    </div>
  </form>
</div>
@endsection
