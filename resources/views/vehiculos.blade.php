@extends('layouts.ojo')

@section('title', 'PIMP|ROPA')

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
      <h2 style="font-family: 'Old English Text MT', sans-serif;">Vehiculos</h2>
      <div class="scrollable-div border-white" style="overflow-x: hidden;">
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
                <a href="{{ route('mostrarProducto', ['id' => $producto->id]) }}" class="btn "><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-eye" viewBox="0 0 16 16">
                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg></a>
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