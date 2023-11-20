<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>    <!-- BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
      /* Estilos para la imagen de fondo */
      .full-width-image {
          width: 100%;
          margin: 0;
          padding: 0;
      }

      .limit-text {
        max-width: 200px; /* Establece el ancho máximo para el párrafo */
        white-space: nowrap; /* Evita el salto de línea */
        overflow: hidden; /* Oculta el contenido que se desborda */
        text-overflow: ellipsis; /* Agrega puntos suspensivos (...) cuando se corta el texto */
      }

      .limit-text-titulo {
        max-width: 500px; /* Establece el ancho máximo para el párrafo */
        white-space: nowrap; /* Evita el salto de línea */
        overflow: hidden; /* Oculta el contenido que se desborda */
        text-overflow: ellipsis; /* Agrega puntos suspensivos (...) cuando se corta el texto */
      }
      .scrollable-div {
            height: 700px; /* Establece la altura máxima para el div desplazable */
            overflow-y: scroll; /* Agrega una barra de desplazamiento vertical */
            border: 1px solid #ccc; /* Agrega un borde para el div */
        }
  </style>
  <style>
    body {
      margin: 0;
      overflow-y: scroll; /* Muestra solo la barra de desplazamiento vertical */
    }

    /* Estilos personalizados para la barra de desplazamiento */
    ::-webkit-scrollbar {
      width: 4px; /* Ancho de la barra de desplazamiento */
    }

    ::-webkit-scrollbar-thumb {
      background-color: #fe4a4a; /* Color de fondo del pulgar (la parte desplazable) */
      border-radius: 6px; /* Borde redondeado del pulgar */
    }

    ::-webkit-scrollbar-track {
      background-color: #00000000; /* Color de fondo de la pista (la parte no desplazable) */
    }
  </style>
  </head>

<body class="fluid" style="margin: 0;overflow-x: hidden;">

{{-- barra navegacion --}}

<nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary">
      <div class="container-fluid">
        <!--Titulo-->
        <a class="navbar-brand" href="{{ route('casa') }}"><h4 style="font-family: 'Old English Text MT', sans-serif;">Pimp</h4></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('carrito.mostrar') }}"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
                  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0h-13zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1zm9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0l-.396-.396zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                </svg>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('ropa') }}">Ropa</a></li>
                <li><a class="dropdown-item" href="{{ route('vehiculos') }}">Vehiculos</a></li>
                <li><a class="dropdown-item" href="{{ route('accesorios') }}">Accesorios</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('casa') }}">Ver casa</a></li>
              </ul>
            </li>
          </ul>
          <!--Boton Login Admin-->
          <form class="d-flex" role="search">
            <a id="btn-login" href="{{ route('login') }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="black" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
              </svg>
          </a>
          </form>
        </div>
      </div>
    </nav>

    {{-- fin barra nav --}}


    {{-- liñita --}}

    <div class="container-fluid bg-danger" style="height: 5px;"> <!-- Ajusta la altura como desees -->
    <div class="row justify-content-center align-items-center" style="height: 100%;">
    </div>
    </div>

    {{-- Fin liñita --}}

    <main>
        @yield('content')
    </main>
    

      <!--FOOTER-->
      <div class="container-fluid bg-danger" style="height: 5px;"> <!-- Ajusta la altura como desees -->
    <div class="row justify-content-center align-items-center" style="height: 100%;">
      </div>
    </div>
      <footer class="bg-black text-light text-center py-3 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>&copy; 2023 PIMP - Vehículos No Motorizados y Mucho estilo Urbano.</h4>
                <p>Contacto: pimp-gomoso@pimp.com</p>
                <p>Teléfono: (+54) 9-387-5666826</p>
                <nav>
                    <a href="#" class="text-danger">Inicio</a> |
                    <a href="#" class="text-danger">Acerca de Nosotros</a> |
                    <a href="#" class="text-danger">Términos y Condiciones</a>
                </nav>
                <p><a href="/politica-de-privacidad" class="text-danger">Política de Privacidad</a></p>
                <img src="tr-logo.png" alt="Afiliado 1" width="105px" class="mx-2">
                <img src="gc-logo.png" alt="Afiliado 2" width="100px" class="mx-2">
                <img src="dc-logo.png" alt="Afiliado 3" width="120px" class="mx-2">

            </div>
        </div>
    </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>    <script>
      document.addEventListener('DOMContentLoaded', function () {
       const offcanvasElementList = document.querySelectorAll('.offcanvas');
       const offcanvasList = [...offcanvasElementList].map(offcanvasEl => new bootstrap.Offcanvas(offcanvasEl));
      });
    </script>
<script>
  document.getElementById('cartButton').addEventListener('click', function(event) {
      event.preventDefault(); // Prevenir el envío del formulario

      // Ocultar el primer botón después de hacer clic
      document.getElementById('cartForm').style.display = 'none';

      // Mostrar el segundo botón
      document.getElementById('secondButton').style.display = 'block';
  });
</script>
</html>

