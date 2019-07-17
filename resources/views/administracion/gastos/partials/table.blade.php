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
          @forelse($Gastos AS $gasto)
              <tr>
                  <td> {{ $gasto->id }} </td>
                  <td> {{ $gasto->concepto }} </td>
                  <td class="text-gray-dark"><b> ${{ number_format($gasto->monto,2) }} </b></td>
                  <td> {{ $gasto->usuario->name }} </td>
                  {{-- <td width="5px">
                  	@can('gastos.show')
                  	<a href="{{route('gastos.show', $gasto->id)}}" class="btn btn-outline-info btn-sm" title="Ver">
                  		<i class="fas fa-list"></i>
                  	</a>
                  	@endcan
                  </td>
                  <td width="5px">
                  	@can('gastos.edit')
                  	<a href="{{route('gastos.edit', $gasto->id)}}" class="btn btn-outline-warning btn-sm" title="Editar">
                  		<i class="fas fa-edit"></i>
                  	</a>
                  	@endcan
                  </td> --}}
                  <td width="5px">
                  	@can('gastos.destroy')
                  	{!! Form::open(['route'=>['gastos.destroy', $gasto->id], 'method'=>'DELETE']) !!}
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
 {{ $Gastos->render() }}
</div>