@extends('layouts.ojo')

@section('title', 'PIMP|ACCESORIOS')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-3 border ">
      <!-- Contenido de las categorias -->
      <h2 style="font-family: 'Old English Text MT', sans-serif;">Categorías</h2>
      <ul class="list-unstyled">
            <li><a class="text-dark" href="{{ route('ropa') }}">Ropa</a>
            <ul>
                <li>Gorros</li>
                <li>Remeras</li>
                <li>Camperas</li>
                <li>Buzos</li>
                <li>Pantalones</li>
                <li>Shorts</li>
                <li>Soquetes</li>
                <li>Zapatillas</li>
            </ul>
            </li>
            <li><a class="text-dark" href="{{ route('vehiculos') }}">Vehículos</a>
            <ul>
                <li>Skates</li>
                <li>Longboards</li>
                <li>Patines</li>
                <li>Bicicletas</li>
                <li>Monopatines</li>
                <li>Uniciclo</li>
                <li>Triciclo</li>
                <li>Zapatillas con rueditas</li>
            </ul>
            </li>
            <li><a class="text-dark" href="{{ route('accesorios') }}">Accesorios</a>
            <ul>
                <li>Cascos</li>
                <li>Gafas</li>
                <li>Protecciones</li>
                <li>Modificables</li>
            </ul>
            </li>
            <li><hr class=""><br></li>
            <li class="d-flex justify-content-center"><a class="btn btn-secondary w-75" href="{{ route('casa') }}">Home</a></li>        </ul>
    </div>


    <div class="col-9 ">
      <h2 style="font-family: 'Old English Text MT', sans-serif;">Accesorios</h2>
      <div class="scrollable-div border-white">
      <!-- Contenido del col-9 sin bordes -->
<!-- Contenido del PRODUCTO (CARD) -->
@foreach($productos as $producto)
<div class="container">
  <div class="row">
    <div class="card m-1">
      <div class="row no-gutters pt-3">
        <div class="col-3">
          <!-- Aquí puedes cargar la imagen del producto -->
          <img src="{{ $producto->imagen }}" class="card-img" alt="Producto" style="max-width:90%; min-width:200px; height: auto;">
        </div>
        <div class="col-9">
          <div class="card-body">
            <div class="row">
                <div class="col-12">
                  <h4 class="card-title limit-text-titulo text-danger">{{ $producto->nombre }}</h4>
                  <p class="card-text limit-text-titulo text-secondary">{{ $producto->descripcion }}</p>
                </div>
            </div>
            <div class="row">
              <div class="col-10 mt-4">
                <h4 class="card-text limit-text text-danger">${{ $producto->precio }}</h4>
              </div>
              <div class="col-2">
                <a href="#" class="btn btn-danger mb-4">Comprar</a>
              </div>
            </div>   
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

      </div>
</div>
</div>

    </div>
  </div>
</div>


@endsection