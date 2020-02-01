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
                        <a href="{{ url('/dokumen-b-a/' . $dokumenba->id . '/edit') }}" title="Edit DokumenBA"><button class="btn btn-rounded btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                       
                         <!-- sample modal content -->      
                        <button type="button" class="btn btn-rounded btn-danger" data-toggle="modal" data-target="#exampleModal"
                            data-whatever="@getbootstrap"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel1">PERINGATAN</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda ingin menghapus dokumen bimbingan akademik ini ???
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['dokumenba', $dokumenba->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-rounded btn-danger',
                                                    'title' => 'Delete DokumenBA',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            ))!!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th> Topik </th><td> {{ $dokumenba->topik }} </td></tr>
                                    <tr><th> Periode </th><td> {{App\Periode::find($dokumenba->periode_id)->nama }} </td></tr>
                                    <tr><th> Semester </th><td>
                                                                 @foreach($smr as $semesterkini)
                                                                    @if($semesterkini->semesterid == $dokumenba->semester_id )
                                                                        {{ $semesterkini->semesternama }} {{ $semesterkini->semestertahun }}/{{ $semesterkini->semestertahun + 1 }}
                                                                    @endif
                                                                 @endforeach 
                                    </td></tr>
                                    <tr><th> Tanggal </th><td> {{ $dokumenba->tanggal }} </td></tr>
                                    <tr><th> Catatan </th><td> {!! $dokumenba->catatan !!} </td></tr>
                                </tbody>
                            </table>
                            <a href="{{ url('print-dokumenba/'.$dokumenba->id) }} " target="_blank" class="btn btn-rounded btn-success pull-right" title="dokumen">
                              <i class="mdi mdi-printer" aria-hidden="true"></i>  </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
