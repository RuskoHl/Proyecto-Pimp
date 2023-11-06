@extends('layouts.ojo')

@section('title', 'PIMP|ROPA')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-3 border ">
      <!-- Contenido de las categorias -->
      <h2 style="font-family: 'Old English Text MT', sans-serif;" >Categorías</h2>
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
            <li class="d-flex justify-content-center"><a class="btn btn-secondary w-75" href="{{ route('casa') }}">Home</a></li>
        </ul>
    </div>


    <div class="col-9">
      <!-- Contenido del col-9 sin bordes -->

      <h2 style="font-family: 'Old English Text MT', sans-serif;">Ropa</h2>

<!-- Contenido del PRODUCTO (CARD) -->

<div class="row m-1">
        <div class="col-12">
        <div class="card border-white" style="min-height: 168px; max-height: 168px;">
            <div class="row no-gutters">
            <div class="bg-image " style="background-image: url('gorilla/4.jpg'); min-width: 115px; max-width: 200px; background-size: cover; background-position: center; background-repeat: no-repeat; margin-left: 12px;">
              </div>
             <div class="col-8">
                <div class="card-body">
                <h5 class="card-title text-danger limit-text-titulo">Remera Negra GC - Oversize.</h5>
                <h6 class="card-subtitle mb-2 text-secondary limit-text">$7.500,00</h6>
                <p class="card-text limit-text">Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.</p>
                <a href="#" class="btn btn-danger ">Ver Detalles</a>
                </div>
              </div>
            </div>
          </div>
        </div>    
  </div>
  <!-- Fin Card del PRODUCTO -->

<!-- Contenido del PRODUCTO (CARD) -->

<div class="row m-1">
        <div class="col-12">
        <div class="card border-white" style="min-height: 168px; max-height: 168px;">
            <div class="row no-gutters">
            <div class="bg-image " style="background-image: url('gorilla/7.jpg'); min-width: 115px; max-width: 200px; background-size: cover; background-position: center; background-repeat: no-repeat; margin-left: 12px;">
              </div>
             <div class="col-8">
                <div class="card-body">
                <h5 class="card-title text-danger limit-text-titulo">Remera Morada GC - Oversize asdasdasdasdasdasdasdas.</h5>
                <h6 class="card-subtitle mb-2 text-secondary limit-text">$7.500,00</h6>
                <p class="card-text limit-text">Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.</p>
                <a href="#" class="btn btn-danger ">Ver Detalles</a>
                </div>
              </div>
            </div>
          </div>
        </div>    
  </div>
  <!-- Fin Card del PRODUCTO -->

  <!-- Contenido del PRODUCTO (CARD) -->

<div class="row m-1">
        <div class="col-12">
        <div class="card border-white" style="min-height: 168px; max-height: 168px;">
            <div class="row no-gutters">
            <div class=" col-4" style="min-width: 150px; max-width: 250px;">

    <div id="carouselExample" class="carousel slide" >
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="gorilla/6.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="gorilla/5.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="gorilla/1.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  </div>
  
          </div>
             <div class="col-8">
                <div class="card-body">
                <h5 class="card-title text-danger limit-text-titulo">Remera Verde GC - Oversize.</h5>
                <h6 class="card-subtitle mb-2 text-secondary limit-text">$7.500,00</h6>
                <p class="card-text limit-text">Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.Edicion limitada.</p>
                <a href="#" class="btn btn-danger ">Ver Detalles</a>
                </div>
              </div>
            </div>
          </div>
        </div>    
  </div>
  <!-- Fin Card del PRODUCTO -->




</div>
</div>

    </div>
  </div>
</div>


@endsection