@extends('layouts.ojo')

@section('title', 'PIMP|ERROR')

@section('content')
<div class="container-fluid h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-6 mx-auto my-5"> <!-- Agregado 'mx-auto' para centrar horizontalmente y 'my-5' para márgenes superior e inferior -->
            <div class="card text-center">
                <div class="card-header">
                    <h2 class="text-danger bold">¡UPS!</h2>
                </div>
                <div class="card-body">
                    <h4>¡Algo salió mal!</h4>
                    <p class="card-text text-secondary">La tienda esta cerrada. Volvemos en 5 minutos.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection