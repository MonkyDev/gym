<div class="form-group">
	{{ Form::label('concepto', 'Concepto') }}
	{{ Form::textarea('concepto', old('concepto'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('monto', 'Monto pago') }}
	{{ Form::text('monto', old('monto'), ['class'=>'form-control']) }}
</div>
<hr>
<div class="form-group">
	{{ Form::submit('Guardar', ['class'=>'btn btn-outline-success']) }}
</div>