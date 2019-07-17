<div class="table-responsive">
	<table class="table table-striped table-hover">
      <thead>
          <tr>
              <th>#</th>
              <th>Concepto</th>
              <th>Monto</th>
              <th>Registra</th>
              <th colspan="3" class="text-center"><i class="fas fa-wrench"></i></th>
          </tr>
      </thead>
      <tbody>
          @forelse($Ingresos AS $ingreso)
              <tr>
                  <td> {{ $ingreso->id }} </td>
                  <td> {{ $ingreso->concepto }} </td>
                  <td class="text-gray-dark"><b> ${{ number_format($ingreso->monto,2) }} </b></td>
                  <td> {{ $ingreso->usuario->name }} </td>
                  {{-- <td width="5px">
                  	@can('ingresos.show')
                  	<a href="{{route('ingresos.show', $ingreso->id)}}" class="btn btn-outline-info btn-sm" title="Ver">
                  		<i class="fas fa-list"></i>
                  	</a>
                  	@endcan
                  </td>
                  <td width="5px">
                  	@can('ingresos.edit')
                  	<a href="{{route('ingresos.edit', $ingreso->id)}}" class="btn btn-outline-warning btn-sm" title="Editar">
                  		<i class="fas fa-edit"></i>
                  	</a>
                  	@endcan
                  </td> --}}
                  <td width="5px">
                  	@can('ingresos.destroy')
                  	{!! Form::open(['route'=>['ingresos.destroy', $ingreso->id], 'method'=>'DELETE']) !!}
                      <button class="btn btn-outline-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                      {!! Form::close() !!}
                  	@endcan
                      
                  </td>
              </tr>
          @empty
          	<tr><td colspan="6" align="center"><strong>Sin registros</strong></td></tr>
          @endforelse
      </tbody>
 </table>
 {{ $Ingresos->render() }}
</div>