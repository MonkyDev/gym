@php
	$meses = [null=>'Seleccione',1=>'ENERO',2=>'FEBRERO',3=>'MARZO',4=>'ABRIL',5=>'MAYO',6=>'JUNIO',7=>'JULIO',8=>'AGOSTO',9=>'SEPTIEMBRE',10=>'OCTUBRE',11=>'NOVIEMBRE',12=>'DICIEMBRE'];
@endphp
<div class="form-group">
	{{ Form::label('cliente_id', 'Eligir Cliente') }}
	{{ Form::select('cliente_id', $clientes, old('cliente_id'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('monto', 'Monto pago') }}
	{{ Form::text('monto', old('monto'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('no_mes', 'Eligir Mes a Pagar') }}
	{{ Form::select('no_mes', $meses, (int)date('m'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('observaciones', 'Observaciones') }}
	{{ Form::textarea('observaciones', old('observaciones'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('fecha_pago', 'Fecha de pago') }}
	{{ Form::date('fecha_pago', date('Y-m-d'), ['class'=>'form-control']) }}
</div>

<hr>
<div class="form-group">
	{{ Form::submit('Guardar', ['class'=>'btn btn-outline-success']) }}
</div>