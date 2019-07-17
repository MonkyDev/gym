<div class="table-responsive">
	<table class="table table-striped table-hover">
      <thead>
          <tr>
              <th>#</th>
              <th>Perfil</th>
              <th>Nombre</th>
              <th>Inscrito</th>
              <th>Mensualidades</th>
              <th class="text-center">Pagos</th>
              <th class="text-center">Entrena</th>
              <th colspan="3" class="text-center"><i class="fas fa-wrench"></i></th>
          </tr>
      </thead>
      <tbody>
          @forelse($Clientes AS $cliente)
              <tr>
                  <td> {{ $cliente->id }} </td>
                  <td> <img src="{{ str_replace('/public', '', Request::root()).'/storage/'.$cliente->foto_perfil }}" class="card-img-top" style="width: 12rem;"> </td>
                  <td> {{ $cliente->full_name }} </td>
                  <td> {{ \Carbon\Carbon::parse($cliente->fecha_inscripcion)->format('d/m/Y') }} </td>
                  <td> {{ $cliente->mensualidades->count() }} </td>
                  <td align="center"> {!! ($cliente->estatus === 'corriente') ? '<i class="fas fa-user-check text-primary"></i>' : '<i class="fas fa-user-clock text-danger"></i>' !!} </td>
                  <td align="center"> {!! $cliente->activo ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-ban text-danger"></i>' !!} </td>
                  <td width="5px">
                  	@can('clientes.show')
                  	<a href="{{route('clientes.show', $cliente->id)}}" class="btn btn-outline-info btn-sm" title="Ver">
                  		<i class="fas fa-list"></i>
                  	</a>
                  	@endcan
                  </td>
                  <td width="5px">
                  	@can('clientes.edit')
                  	<a href="{{route('clientes.edit', $cliente->id)}}" class="btn btn-outline-warning btn-sm" title="Editar">
                  		<i class="fas fa-edit"></i>
                  	</a>
                  	@endcan

                  </td>
                  <td width="5px">
                  	@can('clientes.destroy')
                  	{!! Form::open(['route'=>['clientes.destroy', $cliente->id], 'method'=>'DELETE']) !!}
                      <button class="btn btn-outline-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                      {!! Form::close() !!}
                  	@endcan
                      
                  </td>
              </tr>
          @empty
          	<tr><td colspan="7" align="center"><strong>Sin registros</strong></td></tr>
          @endforelse
      </tbody>
 </table>
 {{ $Clientes->render() }}
</div>