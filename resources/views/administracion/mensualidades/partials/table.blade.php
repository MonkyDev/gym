@php
  $mes = [null=>'Seleccione',1=>'ENERO',2=>'FEBRERO',3=>'MARZO',4=>'ABRIL',5=>'MAYO',6=>'JUNIO',7=>'JULIO',8=>'AGOSTO',9=>'SEPTIEMBRE',10=>'OCTUBRE',11=>'NOVIEMBRE',12=>'DICIEMBRE'];
@endphp
<div class="table-responsive">
	<table class="table table-striped table-hover">
      <thead>
          <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Mensualidad</th>
              <th>Efectuó</th>
              <th>Monto</th>
              <th class="text-center">Mes</th>
              <th>Observaciones</th>
              <th colspan="3" class="text-center"><i class="fas fa-wrench"></i></th>
          </tr>
      </thead>
      <tbody>
          @forelse($Mensualidades AS $mensualidad)
              <tr>
                  <td> {{ $mensualidad->id }} </td>
                  <td> {{ $mensualidad->cliente->full_name }} </td>
                  <td class="text-primary"> {{ \Carbon\Carbon::parse($mensualidad->fecha_mensualidad)->format('d/m/Y') }} </td>
                  <td class="text-success"> {{ \Carbon\Carbon::parse($mensualidad->fecha_pago)->format('d/m/Y') }} </td>
                  <td class="text-gray-dark"><b> ${{ number_format($mensualidad->monto,2) }} </b></td>
                  <td align="center"> {{ $mes[$mensualidad->no_mes] }} </td>
                  <td> {{ $mensualidad->observaciones }} </td>
                  {{-- <td width="5px">
                  	@can('mensualidades.show')
                  	<a href="{{route('mensualidades.show', $mensualidad->id)}}" class="btn btn-outline-info btn-sm" title="Ver">
                  		<i class="fas fa-list"></i>
                  	</a>
                  	@endcan
                  </td>
                  <td width="5px">
                  	@can('mensualidades.edit')
                  	<a href="{{route('mensualidades.edit', $mensualidad->id)}}" class="btn btn-outline-warning btn-sm" title="Editar">
                  		<i class="fas fa-edit"></i>
                  	</a>
                  	@endcan
                  </td> --}}
                  <td width="5px">
                  	@can('mensualidades.destroy')
                  	{!! Form::open(['route'=>['mensualidades.destroy', $mensualidad->id], 'method'=>'DELETE']) !!}
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
 {{ $Mensualidades->render() }}
</div>