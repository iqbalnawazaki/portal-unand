@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <div class="card ">
                <div class="card-body">
                <h5><i class="mdi mdi-timetable"></i> Periode</h5>
                </div>
            </div>
            @if($errors->any())
                 <div class="alert alert-danger"> <i class="fa fa-warning"></i> Periode <span style ="font-size:12px; padding:5px;" class="badge badge-success">Aktif</span> Hanya Boleh Satu.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
            @endif

            <div class="card">
                <div class=card-header>
                <h4><b>Pengaturan Periode Bimbingan Akademik</b></h4>
                <h4><span style ="font-size:12px; padding:5px;" class="badge badge-warning">Status aktif hanya boleh satu</span>
                </div>
              <div class="card-body">
               <form action="{{ url('/admin/periode')}}" method="post">
               {{ csrf_field() }}
                 <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>ID</th> <th>Nama</th><th>Status</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $jumlah_periode = 0; @endphp
                        @foreach($periode as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    @if($item->status == 1)
                                    <span style ="font-size:12px; padding:5px;" class="badge badge-success">Aktif</span>
                                    @elseif($item->status == 0)
                                    <span style ="font-size:12px; padding:5px;" class="badge badge-danger">Tidak aktif</span>
                                    @endif
                                </td>
                                <td>
                                 @foreach($status_krs as $status)
                                  <input type="radio" class="check" id="status_krs" value="{{$status}}" name="status[{{ $item->id }}]" data-radio="iradio_flat-green" @if($status == $item->status) checked @endif>
                                  <label for="flat-radio-1">@if($status == 0) Tidak Aktif @elseif($status == 1 ) Aktif @endif</label>
                                  <br>
                              @endforeach
                                </td>
                            </tr>
                         @php
                            $jumlah_periode += $item->status;
                         @endphp 
                        @endforeach
                        </tbody>
                    </table> 
                </div>
                <button type="submit" @if($jumlah_periode != 1)  @endif class="btn btn-rounded btn-success pull-right">
                  <i class="fa fa-edit "></i> Ubah
                </button> </form>

            </div>
            </div>

        <div class="card">
        <div class="card-header"><b>Kelola Periode Bimbingan Akademik</b></div>
            <div class="card-body">
                <a href="{{ url('/admin/periode/create') }}" class="btn btn-rounded btn-success" title="Add New Periode">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>ID</th> <th>Nama</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($periode as $item)
                            <tr>
                                <td>{{ $item->id }}</td><td>{{ $item->nama }}</td>
                                <td>
                                    <a href="{{ url('/admin/periode/' . $item->id . '/edit') }}" title="Edit Periode"><button class="btn btn-rounded btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/periode', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-rounded btn-danger',
                                                'title' => 'Delete Periode',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
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
