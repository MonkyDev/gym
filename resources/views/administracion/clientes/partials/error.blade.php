<div class="col">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Uppss, algo salió mal... </strong>
       	@foreach ($errors->all() as $error)
       		<ul>
            	<li>{{ $error }}</li>
            </ul>
        @endforeach
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
</div>