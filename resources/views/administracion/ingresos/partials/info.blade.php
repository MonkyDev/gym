<div class="col">
    <div class="alert alert-{{(session('code')==200)? 'info' : 'warning'}} alert-dismissible fade show" role="alert">
      <strong>Respuesta del servidor...</strong>
      	@if ( session('code') == 200 )
          En horabuena, El registro se ha creado exitosamente.
        @elseif( session('code') == 201 )
          En horabuena, El registro se ha actualizado exitosamente.
        @elseif( session('code') == 202 )
          En horabuena, El registro se ha eliminado exitosamente.
      	@elseif( session('code') == 302 )
			     Error al intentar guardar la información.
      	@elseif( session('code') == 303 )
      		Error al intentar guardar el historial.
      	@endif 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
</div>