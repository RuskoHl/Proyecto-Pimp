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


    <div class="col-9">
      <!-- Contenido del col-9 sin bordes -->
      <h2 style="font-family: 'Old English Text MT', sans-serif;">Accesorios</h2>
    </div>
  </div>
</div>

@endsection