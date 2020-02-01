@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Postingan {{ $postingan->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/postingan') }}" title="Back"><button class="btn btn-rounded btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/postingan/' . $postingan->id . '/edit') }}" title="Edit Postingan"><button class="btn btn-rounded btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/postingan', $postingan->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-rounded btn-danger',
                                    'title' => 'Delete Postingan',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $postingan->id }}</td>
                                    </tr>
                                    <tr><th> Judul </th><td> {{ $postingan->judul }} </td></tr><tr><th> Waktu </th><td> {{ $postingan->waktu }} </td></tr><tr><th> Konten </th><td> {!! $postingan->konten !!} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
