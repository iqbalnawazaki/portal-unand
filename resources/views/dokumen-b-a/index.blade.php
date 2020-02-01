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
                        <div class="table-responsive">
                          <table class="table-striped-info">
                            <tbody>
                              <tr><th> Nama </th><td>: {{ ucwords(strtolower($mhs->nama)) }} </td></tr>
                              <tr><th> No BP </th><td>: {{ $mhs->nim }} </td></tr>
                              <tr><th> Program Studi</th><td>: {{ ucwords(strtolower($mhs->jurusan)) }} </td></tr>
                              <tr><th> Dosen PA </th><td>: {{ $mhs->gelarDepanPA }}{{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }} </td></tr>
                            </tbody>
                          </table>
                        </div>
                        <br>

                        <div class="table-responsive">
                          <a href="{{ url('/dokumen-b-a/create') }}" class="btn btn-rounded btn-success" title="Add New DokumenBA">
                            <i class="fa fa-plus" aria-hidden="true"></i></a>

                          <a href="{{ url('/chatting') }}" class="pull-right btn btn-rounded btn-primary" title="Chatting">
                            <i class="mdi mdi-message-text" aria-hidden="true"></i></a><br><br>
                            <table class="table-striped table color-bordered-table success-bordered-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Topik</th>
                                        <th class="text-center">Periode</th>
                                        <th class="text-center">Semester</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($dokumenba as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->topik }}</td>
                                        <td class="text-center">{{App\Periode::find($item->periode_id)->nama }}</td>
                                        <td class="text-center">
                                            @foreach($smr as $semesterkini)
                                            @if($semesterkini->semesterid == $item->semester_id )
                                                {{ $semesterkini->semesternama }} {{ $semesterkini->semestertahun }}/{{ $semesterkini->semestertahun + 1 }}
                                            @endif
                                            @endforeach 
                                        </td>
                                        <td class="text-center">{{ $item->tanggal }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/dokumen-b-a/' . $item->id) }}" title="Lihat dokumen"><button class="btn btn-rounded btn-info"><i class="fa  fa-search" aria-hidden="true"></i> </button></a>
                                            <a href="{{ url('/dokumen-b-a/' . $item->id . '/edit') }}" title="Edit dokumen"><button class="btn btn-rounded btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            
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
                                                                    'url' => ['/dokumen-b-a', $item->id],
                                                                    'style' => 'display:inline'
                                                                ]) !!}
                                                                 {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                                            'type' => 'submit',
                                                                            'class' => 'btn btn-rounded btn-danger'
                                                                    )) !!}
                                                                    
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.modal -->
                                        </td>
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
