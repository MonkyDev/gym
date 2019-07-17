@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header text-primary">
                    <h5> {{$Cliente->full_name}} </h5>
                </div>

                <div class="card-body">
                    <i class="fas fa-user fa-5x text-secondary float-left"></i>
                    <p class="float-right">
                    Creado: {{ \FormatDateTime::LongTimeFilter($Cliente->created_at)}}
                    <br>
                    Actualizado: {{ \FormatDateTime::LongTimeFilter($Cliente->updated_at)}}
                    </p>
                    <div class="clearfix"></div>
                    <hr>
                    <h3>Datos Personales</h3>
                    <p>
                        <label>Clave <strong>{{$Cliente->id}}</strong></label>
                        <br>
                        <label>Fecha inscripción: <strong>{{ \Carbon\Carbon::parse($Cliente->fecha_inscripcion)->format('d/m/Y') }}</strong></label>
                        <br>
                        <label>Celular: <strong>{{$Cliente->celular}}</strong></label>
                        <br>
                        <label>Estatus de Pagos: <strong>{!! $Cliente->estatus ? '<i class="fas fa-user-check text-primary"></i>' : '<i class="fas fa-user-clock text-danger"></i>' !!}</strong></label>
                        <br>
                        <label>Acude a entrenar: <strong>{!! $Cliente->activo ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-ban text-danger"></i>' !!}</strong></label>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection