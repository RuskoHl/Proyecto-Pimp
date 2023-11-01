@extends('adminlte::page')

@section('title','Inicio')

@section('content_header')
<h1 style="font-family: 'Old English Text MT', sans-serif; font-size: 60px;">Pimp</h1>

@stop

@section('content')
<div>
    <div>
        <div>
            <h4>Listas de productos:</h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('ropa') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-success">
                   
                    <div class="card-body">
                        <h5 class="card-title">Ropa</h5>
                        <p class="card-text">Acceso rapido a Pantalla de ropa.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('vehiculos') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-warning">
                   
                    <div class="card-body">
                        <h5 class="card-title">Vehiculos</h5>
                        <p class="card-text">Acceso rapido a Pantalla de vehiculos.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('accesorios') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-danger">
                   
                    <div class="card-body">
                        <h5 class="card-title">Accesorios</h5>
                        <p class="card-text">Acceso rapido a Pantalla de accesorios.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop