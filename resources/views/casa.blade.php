@extends('layouts.ojo')

@section('title', 'PIMP')

@section('content')
    <!--BodyPagprincipal-->
    
    {{-- imagen  --}}
    <div class="position-relative">
      <!-- Video y capa de entumecimiento -->
      <video autoplay muted loop class="w-100 mt-1" id="background-video">
          <source src="{{ asset('1.mp4') }}" type="video/mp4">
          Tu navegador no soporta el elemento de video.
      </video>
      
      <!-- Capa de entumecimiento -->
      <div class="position-absolute text-center text-white w-100" id="overlay-text">
          <h1 style="font-family: 'Old English Text MT', sans-serif; font-size: 7em;">Pimp</h1>
          <p class="text-danger" style="font-family: 'Old English Text MT', sans-serif;">
            Wheels & Clothes.
          </p>
          {{-- <div class="container mt-5">
              <div class="row justify-content-center">
                  <div class="col-md-8">
                      <form action="/users/search" method="GET" class="form-inline">
                          <div class="input-group">
                              <input type="text" name="query" class="form-control" placeholder="Buscar productos">
                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-danger">Buscar</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          <!-- Agrega más contenido si es necesario --> --}}
      </div>
  </div>
    {{-- fin imagen  --}}

    <!--Liñita-->
    <div class="container-fluid bg-danger" style="height: 5px;"> <!-- Ajusta la altura como desees -->
    <div class="row justify-content-center align-items-center" style="height: 100%;">
    </div>
    </div>
    <!--Fin Liñita-->

    <!--Comienzo Renglon que debe ser fijo-->
    <div class="container-fluid mt-3 mb-2">
      <div class="row justify-content-between">
          <!-- Columna para la imagen -->
          <div class="col-md-2">
              <img src="aaa.png" alt="Tu imagen" class="img-fluid d-none d-md-block">
          </div>
          <!-- Columna para el texto -->
          <div class="col-md-8 text-center">
              <h1 style="font-family: 'Old English Text MT', sans-serif;">Productos</h1>
              <p class="text-danger">Nuestros productos en un abrir y cerrar de ojos.</p>
          </div>
          <!-- Columna para la imagen -->
          <div class="col-md-2">
              <img src="bbb.png" alt="Tu imagen" class="img-fluid d-none d-md-block">
          </div>
      </div>
  </div>
  <!--FinRenglon-->




  {{-- CARDS PRODUCTOS --}}

      <div class="container mt-2 mb-2">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card bg-black" style="width: 100%;">
                    <img src="Ropa1.jpg" class="card-img-top text-danger" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-white" style="font-family: 'Old English Text MT', sans-serif;">Ropa</h5>
                        <p class="text-secondary">Descubrí moda única.</p>
                        <a href="{{ route('ropa') }}" class="btn btn-danger">Ver Ropa</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-black" style="width: 100%;">
                    <img src="vehiculos.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-white" style="font-family: 'Old English Text MT', sans-serif;">Vehiculos</h5>
                        <p class="text-secondary">Rodá con onda.</p>
                        <a href="{{ route('vehiculos') }}" class="btn btn-danger">Ver vehiculos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-black" style="width: 100%;">
                    <img src="accesorios.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-white" style="font-family: 'Old English Text MT', sans-serif;">Accesorios</h5>
                        <p class="text-secondary">Detalles que destacan.</p>
                        <a href="{{ route('accesorios') }}" class="btn btn-danger">Ver accesorios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- FIN CARD PRODUCTOS --}}


        <!--marquita-->

        <div class="container-fluid m-2 mb-3">
          <div class="row justify-content-between">
              <!-- Columna para la imagen -->
              <div class="col-md-2">
                  <img src="aaa.png" alt="Tu imagen" class="img-fluid d-none d-md-block">
              </div>
              <!-- Columna para el texto -->
              <div class="col-md-8 text-center">
                  <h1  style="font-family: 'Old English Text MT', sans-serif;">Nosotros</h1>
                  <p class="text-danger">¿Quienes somos?</p>
              </div>
              <!-- Columna para la imagen -->
              <div class="col-md-2">
                  <img src="bbb.png" alt="Tu imagen" class="img-fluid d-none d-md-block">
              </div>
          </div>
      </div>

    <!--CARRUCEL-->

    

  <div class="container-fluid bg-danger" style="height: 5px;"> <!-- Ajusta la altura como desees -->
    <div class="row justify-content-center align-items-center" style="height: 100%;">
    </div>
    </div>
    <!--Fin Liñita-->
    <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="carr/1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="carr/2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="carr/3.jpg" class="d-block w-100" alt="...">
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

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
      $(document).ready(function () {
          positionText();

          // Vuelve a posicionar el texto cuando cambia el tamaño de la ventana
          $(window).resize(function () {
              positionText();
          });

          // Carga el video después de que se haya posicionado el texto
          var video = document.getElementById('background-video');
          video.load();
      });

      function positionText() {
          var windowHeight = $(window).height();
          var textHeight = $('#overlay-text').height();

          // Ajusta la posición vertical del texto
          var verticalPosition = (windowHeight - textHeight) / 5.3; // Cambié el divisor a 3
          $('#overlay-text').css('top', verticalPosition + 'px');
      }
  </script>
@endsection