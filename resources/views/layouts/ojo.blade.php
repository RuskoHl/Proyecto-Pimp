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
              <a class="nav-link active" aria-current="page" href="{{ route('carrito.mostrar') }}">Carrito</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categorías
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
            <a id="btn-login" href="{{ route('home') }}" class="btn btn-danger">Login</a>
          </form>
          
<!--OFFVANVAS DE CARRITO


<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    ...
  </div>
</div>


FIN OFFCANVAS-->

        </div>
      </div>
    </nav>

    <div class="container-fluid bg-danger" style="height: 5px;"> <!-- Ajusta la altura como desees -->
    <div class="row justify-content-center align-items-center" style="height: 100%;">
      </div>
    </div>

    <main>
        @yield('content')
    </main>
    

      <!--FOOTER-->
      <div class="container-fluid bg-danger" style="height: 5px;"> <!-- Ajusta la altura como desees -->
    <div class="row justify-content-center align-items-center" style="height: 100%;">
      </div>
    </div>
      <footer class="bg-dark text-light text-center py-3 ">
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

