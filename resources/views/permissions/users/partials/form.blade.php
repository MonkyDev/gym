<div class="form-group">
	{{ Form::label('name', 'Nombre del usuario') }}
	{{ Form::text('name', null, ['class'=>'form-control']) }}
</div>
<hr>
<h3>Lista de roles</h3>
<div class="form-grouop">
	<ul class="list-unstyled">
		@foreach($roles as $role)
			<li>
				<label>
					{{ Form::checkbox('roles[]', $role->id, null) }}
					{{ $role->name }}
					<em> {{ $role->description ?: '(sin descripción)' }} </em>
				</label>
			</li>
		@endforeach
	</ul>
</div>




<div class="form-group">
	{{ Form::submit('Guardar', ['class'=>'btn btn-outline-primary btn-sm']) }}
</div>