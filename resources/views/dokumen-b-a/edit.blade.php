@extends('layouts.mahasiswa')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="card ">
                  <div class="card-body">
                      <h5><i class="mdi mdi-account-multiple"></i> Bimbingan Akademik</h5>
                  </div>
              </div>

                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/dokumen-b-a') }}" title="Back"><button class="btn btn-rounded btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($dokumenba, [
                            'method' => 'PATCH',
                            'url' => ['/dokumen-b-a', $dokumenba->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('dokumen-b-a.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
