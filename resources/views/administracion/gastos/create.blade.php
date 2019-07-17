@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header text-secondary">
                    <h5>Registro del Nueva Mensualidad</h5>
                </div>

                <div class="card-body">
                    {!! Form::open(['route' => 'mensualidades.store']) !!}
                        
                        @include('administracion.mensualidades.partials.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <br>
    @if ($errors->any())
        @include('administracion.mensualidades.partials.error')
    @endif
</div>
@endsection