@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/user/create') }}" class="btn btn-rounded btn-success" title="Add New user">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>No</th><th>Nama</th><th>NIP</th><th>Email</th><th>Role</th><th>Actions</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1
                                @endphp
                                <tbody>
                                @foreach($dosen as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                          <h5>
                                            @foreach ($item->roles()->pluck('name') as $role)
                                            <span class="badge badge-primary">{{ $role }}</span>
                                            @endforeach
                                          </h5>
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/user/' . $item->id) }}" title="View user"><button class="btn btn-rounded btn-info"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/user/' . $item->id . '/edit') }}" title="Edit user"><button class="btn btn-rounded btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/user', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-rounded btn-danger',
                                                        'title' => 'Delete user',
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
