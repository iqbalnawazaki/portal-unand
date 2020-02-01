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
                        <a href="{{ url('bimbingan-dokumen', $dokumenBALihat->nim )}}" title="Back"><button class="btn btn-rounded btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th> Topik </th><td> {{ $dokumenBALihat->topik }} </td></tr>
                                    <tr><th> Periode </th><td> {{ $dokumenBALihat->nama }} </td></tr>
                                    <tr><th> Tanggal </th><td> {{ $dokumenBALihat->tanggal }} </td></tr>
                                    <tr><th> Catatan </th>
                                        <td>
                                          {!! $dokumenBALihat->catatan !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ url('print-dokumen/'.$dokumenBALihat->nim.'/'.$dokumenBALihat->iddokumen) }}" target="_blank" class="btn btn-rounded btn-success pull-right" title="dokumen">
                              <i class="mdi mdi-printer" aria-hidden="true"></i>  </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
