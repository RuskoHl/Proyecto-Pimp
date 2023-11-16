@extends('adminlte::page')

@section('title','PimpAdmin')

@section('content_header')
<h1 style="font-family: 'Old English Text MT', sans-serif; font-size: 60px;">Pimp</h1>

@stop

@section('content')
@inject('productos', 'App\Models\Producto')
<div>
    <div>
        <div>
            <a class="text-danger">Wheels & Clothes</a><a>.</a> <br><br>
        </div>
    </div>
</div>

<div class="container-fluid bg-danger" style="height: 2px;"> <!-- Ajusta la altura como desees -->
    <div class="row justify-content-center align-items-center" style="height: 100%;">
      </div>
    </div>


    <div class="container-fluid bg-dark" style="height: 2px;"> <!-- Ajusta la altura como desees -->
        <div class="row justify-content-center align-items-center" style="height: 100%;">
          </div>
        </div>

<br>
<!-- COMIENZO VISTAS ADMINS -->
<h3 style="font-family: 'Old English Text MT', sans-serif;">Atajos Administrativos:</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <a href="{{ route('producto.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-black">
                   
                    <div class="card-body">
                        <h5 class="card-title"><strong class="text-danger">Cantidad Productos</strong></h5>
                        <p class="card-text"> Hay <strong>{{ App\Models\Producto::count() }}</strong> productos en la base de datos.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a href="{{ route('caja.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-black">
                   
                    <div class="card-body">
                        <h5 class="card-title"><strong class="text-danger">Cantidad Cajas Activas</strong></h5>
                        <p class="card-text"> Hay <strong>{{ App\Models\Caja::where('status', 1)->count() }}</strong> cajas acivas.</p>
                    </div>
                </div>
            </a>
        </div>

<!-- FIN VISTAS ADMINS -->

        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
</div>
<h3 style="font-family: 'Old English Text MT', sans-serif;">Vistas usuario administrativo:</h3>
<div class="container-fluid">
    <div class="row">

        <div class="col-6">
            <a href="{{ route('caja.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-secondary ">
                   
                    <div class="card-body">
                        <h5 class="card-title">Listado de Cajas</h5>
                        <p class="card-text">Acceso rapido a Pantalla de Cajas.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6">
            <a href="{{ route('caja.create')}}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-secondary">
                   
                    <div class="card-body">
                        <h5 class="card-title">Abrir una nueva caja</h5>
                        <p class="card-text">Acceso rapido a create caja .</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
    <div class="row">

        <div class="col-6">
            <a href="{{ route('producto.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-dark">
                   
                    <div class="card-body">
                        <h5 class="card-title">Listado de Productos</h5>
                        <p class="card-text">Acceso rapido a Pantalla de Productos.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6">
            <a href="{{ route('producto.create')}}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-dark">
                   
                    <div class="card-body">
                        <h5 class="card-title">Añadir un nuevo producto</h5>
                        <p class="card-text">Acceso rapido a create producto .</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>

    <div class="row">

        <div class="col-6">
            <a href="{{ route('proveedor.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-black ">
                   
                    <div class="card-body">
                        <h5 class="card-title">Listado de Proveedor</h5>
                        <p class="card-text">Acceso rapido a Pantalla de Proveedor.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6">
            <a href="{{ route('proveedor.create')}}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-black">
                   
                    <div class="card-body">
                        <h5 class="card-title">Añadir un nuevo proveedor</h5>
                        <p class="card-text">Acceso rapido a create proveedor .</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
</div>

<div class="container-fluid">
    <div class="row">



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