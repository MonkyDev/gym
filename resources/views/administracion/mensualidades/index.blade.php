@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                	<h3> 
                		Control de Mensualidades
                		@can('mensualidades.create')
                		<a href="{{route('mensualidades.create')}}" class="btn btn-outline-primary btn-sm float-right"><i class="fas fa-dollar-sign"></i>&nbsp;Pagar Mensualidad</a>
                		@endcan
                	</h3>
                	{{ Form::model(Request::all(), ['route'=>'mensualidades.index', 'method'=>'PUT']) }}
                	<div class="input-group mb-3">
					    <input type="text" name="keyword_search" class="form-control" placeholder="Buscar ingrese el nombre del cliente">
					       <div class="input-group-append">
    					    <button class="btn btn-outline-info" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
    					    <button class="btn btn-outline-danger" onclick="location.href='{{ route('mensualidades.index') }}'" id="button-addon2"><i class="fas fa-times"></i></button>
					    </div>
					</div>
                	{{ Form::close() }}
                </div>

                <div class="card-body">
			    @include('administracion.mensualidades.partials.table')
                @if( session('code') )
			        @include('administracion.mensualidades.partials.info')
			    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection