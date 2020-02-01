@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h4><span style ="font-size:12px; padding:5px;" class="badge badge-success">Petunjuk Pembuatan Topik</span>
                      <h6>Kode <b>1</b> : Persetujuan KRS </h6>
                      <h6>Kode <b>2</b> : Kartu UTS </h6>
                      <h6>Kode <b>3</b> : Kartu UAS </h6>
                      <h6>Kode <b>8</b> : Untuk group chat </h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Topik</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/topik-bimbinganakademik/create') }}" class="btn btn-rounded btn-success" title="Add New Topik">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Kode [ID]</th><th>Topik</th><th>Periode</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($topik as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->topik }}</td>
                                         <td>{{App\Periode::find($item->periode_id)->nama }}</td>
                                        <td>
                                            <a href="{{ url('/admin/topik-bimbinganakademik/' . $item->id . '/edit') }}" title="Edit Topik"><button class="btn btn-rounded btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/topik-bimbinganakademik', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-rounded btn-danger',
                                                        'title' => 'Delete Topik',
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
