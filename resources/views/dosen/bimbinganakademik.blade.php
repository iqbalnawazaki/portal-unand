@extends('layouts.dosen')

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
                      <div class="row justify-content-between">
                        <div class="col-8">
                            <div class="table-responsive">
                            <table class="table-striped-info">
                                <tbody>
                                @foreach($dsn as $dosen)
                                <tr><th> Nama </th><td>:  {{ $dosen->gelar_depan }} {{ $dosen->nama }}, {{ $dosen->gelar_belakang }} </td></tr>
                                <tr><th> NIP </th><td>:  {{ $dosen->nip }} </td></tr>
                                <tr><th> Program Studi</th><td>:  {{ $dosen->jurusan }} </td></tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="col-4">
                            <a href="{{ url('/chatting') }}" class="pull-right btn btn-rounded btn-success" title="Chatting">
                            <i class="mdi mdi-message-text" aria-hidden="true"></i> Chat</a>
                        </div>
                    </div>
                   <div><hr></div>
                        <div class="table-responsive">
                            <table class="table-striped table color-bordered-table success-bordered-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NO BP</th>
                                        <th>NAMA</th>
                                        <th class="text-center">PROGRAM STUDI</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                @php
                                  $no = 1
                                @endphp
                                <tbody>
                                @foreach($dsnpa as $pa)
                                    <tr>
                                        <td class="text-center"> {{ $no++ }} </td>
                                        <td class="text-center"> {{ $pa->pa_nim }} </td>
                                        <td> {{ $pa->pa_nama }} </td>
                                        <td class="text-center"> {{ $pa->jurusan }} </td>
                                        <td class="text-center"> <a href="{{ url('bimbingan-dokumen', $pa->pa_nim )}}" title="Lihat mahasiswa"><button class="btn btn-rounded btn-success"><i class="mdi mdi-file-find" aria-hidden="true"></i></button></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
