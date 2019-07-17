@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @can('ingresos.create')
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3>Registrar Ingreso de Dinero</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'ingresos.store']) !!}
                        
                        @include('administracion.ingresos.partials.form')

                    {!! Form::close() !!}
                </div>
            </div>
            <br>
             @if ($errors->any())
                @include('administracion.ingresos.partials.error')
            @endif
        </div>
        @endcan
        <div class="col">
            <div class="card">
                <div class="card-header">
                	<h3> 
                		Control de Ingresos del Diario
                		{{-- @can('ingresos.create')
                		<a href="{{route('ingresos.create')}}" class="btn btn-outline-primary btn-sm float-right"><i class="fas fa-dollar-sign"></i>&nbsp;Registrar</a>
                		@endcan --}}
                	</h3>
                	{{ Form::model(Request::all(), ['route'=>'ingresos.index', 'method'=>'PUT']) }}
                	<div class="input-group mb-3">
					    <input type="date" name="date_search" class="form-control">
					       <div class="input-group-append">
    					    <button class="btn btn-outline-info" type="submit" id="button-addon2"><i class="fas fa-filter"></i></button>
    					    <button class="btn btn-outline-danger" onclick="javascript: location.href='{{ route('ingresos.index') }}'" id="button-addon2"><i class="fas fa-times"></i></button>
					    </div>
					</div>
                	{{ Form::close() }}
                </div>

                <div class="card-body">
                <div class="row mb-4" style="font-size: 1.3rem;">
                    <div class="col-12"><strong class="float-left">Ingresos:</strong><span class="float-right text-success">${{ number_format($to_ingresos,2) }}</span></div>
                    <div class="col-12" style="border-bottom: .2px solid;"><strong class="float-left">Gastos:</strong><span class="float-right text-danger">- ${{ number_format($to_gastos,2) }}</span></div>
                    <div class="col-12"><strong class="float-left">Total:</strong><span class="float-right text-muted">${{ number_format($to_ventas,2) }}</span></div>
                </div>
			    @include('administracion.ingresos.partials.table')
                @if( session('code') )
			        @include('administracion.ingresos.partials.info')
			    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection