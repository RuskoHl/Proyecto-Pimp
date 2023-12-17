@extends('layouts.ojo')

@section('title', 'PIMP')

@section('content')
    <!--BodyPagprincipal-->
    
{{-- Video --}}
<div class="position-relative mt-1">
    <!-- Video y capa de entumecimiento -->
    <video autoplay muted loop class="w-100" id="background-video" style="height: 400px; width: 100%; object-fit: cover;">
        <source src="{{ asset('1.mp4') }}" type="video/mp4">
        Tu navegador no soporta el elemento de video.
    </video>

    <!-- Capa de entumecimiento -->
    <div class="position-absolute text-center text-white w-100" id="overlay-text">
        <h1 style="font-family: 'Old English Text MT', sans-serif; font-size: 7em;">Pimp</h1>
        <p class="text-danger" style="font-family: 'Old English Text MT', sans-serif;">Wheels & Clothes.</p>
    </div>
</div>
    <!-- Línea -->
    <div class="container-fluid bg-black mb-1" style="height: 5px;"> <!-- Ajusta la altura como desees -->
        <div class="row justify-content-center " style="height: 100%;"></div>
    </div>
    <!-- Fin Línea -->

    <!--Comienzo Renglon que debe ser fijo-->
    <div class="container-fluid mt-3 mb-2">
      <div class="row justify-content-between">
          <!-- Columna para la imagen -->
          <div class="col-md-2">
              <img src="aaa.png" alt="Tu imagen" class="img-fluid d-none d-md-block">
          </div>
          <!-- Columna para el texto -->
          <div class="col-md-8 text-center">
              <h1 style="font-family: 'Old English Text MT', sans-serif;">Categorías</h1>
              <p class="text-danger">Nuestros productos en un abrir y cerrar de ojos.</p>
          </div>
          <!-- Columna para la imagen -->
          <div class="col-md-2">
              <img src="bbb.png" alt="Tu imagen" class="img-fluid d-none d-md-block">
          </div>
      </div>
  </div>
  <!--FinRenglon-->
  {{-- CARDS CATEGORIAS --}}

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


    {{-- DIV OFERTAS --}}

<div id="desaparecerSinOfertas">
    <!-- Línea -->
    <div class="container-fluid bg-black mb-1" style="height: 5px;"> <!-- Ajusta la altura como desees -->
        <div class="row justify-content-center " style="height: 100%;"></div>
    </div>
    <!-- Fin Línea -->
    
    
    <div class="row" style="background-image: url('{{ asset('ofertasPimp.png') }}'); background-size: cover; color: #fff;">
        {{-- Primera columna --}}
        <div class="col-md-5 text-left mt-1 ">
            @if(isset($oferta))
                <div class="text-left">
                    <h1 style="margin-left: 40px; font-family: 'Old English Text MT', sans-serif; font-size: 4em;" class=" text-dark"><span id="cambioColor">¡{{ $oferta->titulo }}!</span></h1>
                    <p class="text-dark mt-2" style="margin-left: 40px; font-size: 1.5em; font-family: 'Old English Text MT', sans-serif;">{{ $oferta->descripcion }}</p>
                    <p class="text-dark mb-4" style="margin-left: 40px; font-family: 'Old English Text MT', sans-serif;font-size: 1.5em;">¡Hasta un <span id="cambioColor2" style="font-size: 1.5em;">{{ number_format(floatval($oferta->monto_descuento), 0) }}%</span> de descuento!</p>
                    <a href="{{ route('ofertas') }}" class="transparent-button" style="margin-left: 40px;">Ir a Ofertas</a>
                </div>
            @else
                <p class="text-white" >No hay ofertas disponibles en este momento.</p>
            @endif
            <br><br><br>
        </div>
                {{-- Segunda columna --}}
        <div class="col-md-7 d-flex align-items-center justify-content-center">
            <!--Nullo Xq Pinta -->
        </div>
    </div>
    
    
    <!-- Línea -->
    <div class="container-fluid bg-black mt-1" style="height: 5px;"> <!-- Ajusta la altura como desees -->
        <div class="row justify-content-center align-items-center" style="height: 100%;"></div>
    </div>
    <!-- Fin Línea -->
    </div>
    
    
      {{-- DIV OFERTAS --}}

    <!--Comienzo Renglon que debe ser fijo-->
    <div class="container-fluid mt-3 mb-2">
        <div class="row justify-content-between">
            <!-- Columna para la imagen -->
            <div class="col-md-2">
                <img src="aaa.png" alt="Tu imagen" class="img-fluid d-none d-md-block">
            </div>
            <!-- Columna para el texto -->
            <div class="col-md-8 text-center">
                <h1 style="font-family: 'Old English Text MT', sans-serif;">Nosotros</h1>
                <p class="text-danger">¿Quienes somos?</p>
            </div>
            <!-- Columna para la imagen -->
            <div class="col-md-2">
                <img src="bbb.png" alt="Tu imagen" class="img-fluid d-none d-md-block">
            </div>
        </div>
    </div>
    <!--FinRenglon-->

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
        // Inicialización
        positionText();
        var video = document.getElementById('background-video');
        video.load();
    
        // Intervalo para reposicionar el texto y cambiar el color
        setInterval(function () {
            positionText();
            changeTextColor('#cambioColor');
            changeTextColor('#cambioColor2');
        }, 500);
    
        // Oculta el div si no hay ofertas
        var ofertaPresente = "{{ isset($oferta) }}";
        if (!ofertaPresente) {
            $('#desaparecerSinOfertas').hide();
        }
    });
    
    function positionText() {
        var windowHeight = $(window).height();
        var textHeight = $('#overlay-text').height();
        var verticalPosition = (windowHeight - textHeight) / 4;
        $('#overlay-text').css('top', verticalPosition + 'px');
    }
    
    function changeTextColor(element) {
        // Alterna el color del texto entre rojo y negro cada medio segundo
        var currentColor = $(element).css('color');
        var newColor = (currentColor === 'rgb(0, 0, 0)' || currentColor === 'black') ? 'red' : 'black';
        $(element).css('color', newColor);
    }
    </script>
        <style>
        /* Estilos del botón */
        .transparent-button {
            background-color: transparent;
            border: 2px solid #ff0000; /* Cambiado a rojo (#ff0000) */
            color: #ff0000; /* Color del texto igualmente cambiado a rojo (#ff0000) */
            padding: 10px 20px; /* Ajusta el espaciado interno */
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Cambia los estilos al pasar el mouse sobre el botón */
        .transparent-button:hover {
            background-color: #ff0000; /* Cambia el color de fondo al pasar el mouse a rojo (#ff0000) */
            color: #ffffff; /* Cambia el color del texto al pasar el mouse a blanco (#ffffff) */
        }
    </style>
@endsection