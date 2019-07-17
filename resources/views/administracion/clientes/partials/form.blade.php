<div class="form-group">
	{{ Form::label('foto_perfil', 'Foto de Perfil') }}
	{{ Form::file('foto_perfil', old('foto_perfil'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('nombres', 'Nombres') }}
	{{ Form::text('nombres', old('nombres'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('paterno', 'Apellido Paterno') }}
	{{ Form::text('paterno', old('paterno'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('materno', 'Apellido Materno') }}
	{{ Form::text('materno', old('materno'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('fecha_inscripcion', 'Fecha de Inscripción') }}
	{{ Form::date('fecha_inscripcion', old('fecha_inscripcion'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('genero', 'Género') }}
	{{ Form::select('genero', [null=>'Seleccione', 'hombre'=>'Hombre', 'mujer'=>'Mujer'], old('genero'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('celular', 'Número Celular') }}
	{{ Form::text('celular', old('celular'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('facebook', 'Facebook') }}
	{{ Form::text('facebook', old('facebook'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('nacimiento', 'Fecha de Nacimiento') }}
	{{ Form::date('nacimiento', old('nacimiento'), ['class'=>'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('activo', 'Activo') }}
	{{ Form::select('activo', [null=>'Seleccione', 1=>'Si', 0=>'No'], old('activo'), ['class'=>'form-control']) }}
</div>
<hr>
<div class="form-group">
	{{ Form::submit('Guardar', ['class'=>'btn btn-outline-success']) }}
</div>