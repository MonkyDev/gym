@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header text-secondary">
                    <h5>Registro del Nuevo Cliente</h5>
                </div>

                <div class="card-body">
                    {!! Form::model($Cliente, ['route' => ['clientes.update', $Cliente], 'method' => 'PUT' ]) !!}
                        
                        @include('administracion.clientes.partials.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <br>
    @if ($errors->any())
        @include('administracion.clientes.partials.error')
    @endif
</div>
@endsection