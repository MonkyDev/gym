@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Roles
                    @can('roles.create')
                        <a href="{{ route('roles.create') }}" class="btn btn-outline-primary btn-sm float-right">crear</a>
                    @endcan
                </div>

                <div class="card-body">
                   <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rol</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles AS $role)
                                <tr>
                                    <td> {{ $role->id }} </td>
                                    <td> {{ $role->name }} </td>
                                    <td width="10px">
                                        @can('roles.show')
                                        <a href=" {{ route('roles.show', $role->id) }} " class="btn btn-outline-info btn-sm">ver</a>
                                        @endcan
                                    </td>
                                    <td width="10px">
                                        @can('roles.edit')
                                        <a href=" {{ route('roles.edit', $role->id) }} " class="btn btn-outline-info btn-sm">editar</a>
                                        @endcan
                                    </td>
                                    <td width="10px">
                                        @can('roles.destroy')
                                        {!! Form::open(['route'=>['roles.destroy',$role->id], 'method'=>'DELETE']) !!}
                                        <button class="btn btn-outline-danger btn-sm">eliminar</button>
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                   </table>
                   {{ $roles->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
