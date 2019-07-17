@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                	<h3> 
                		Control de Clientes
                		@can('clientes.create')
                		<a href="{{route('clientes.create')}}" class="btn btn-outline-primary btn-sm float-right">Agregar nuevo cliente</a>
                		@endcan
                	</h3>
                	{{ Form::model(Request::all(), ['route'=>'clientes.index', 'method'=>'PUT']) }}
                	<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <a class="btn btn-outline-dark" href="{{ route('clientes.filter', 'vencidos') }}" id="button-addon1"><i class="fas fa-user-clock"></i>&nbsp;Filtrar Vencidos</a>
                        </div>
					    <input type="text" name="keyword_search" class="form-control" placeholder="Buscar ingrese el nombre del cliente">
					    <div class="input-group-append">
					        <button class="btn btn-outline-info" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
					        <button class="btn btn-outline-danger" onclick="location.href='{{ route('clientes.index') }}'" id="button-addon2"><i class="fas fa-times"></i></button>
					    </div>
					</div>
                	{{ Form::close() }}
                </div>

                <div class="card-body">
					@include('administracion.clientes.partials.table')
                    
                    @if( session('code') )
				        @include('administracion.clientes.partials.info')
				    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection