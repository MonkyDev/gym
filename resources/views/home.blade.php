@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Bienvenido!</h3></div>

                <div class="card-body text-success">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5>Sistema Administrador de {{ ucwords(strtolower($instituto)) }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
