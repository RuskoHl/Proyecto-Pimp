<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>    <!-- BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
      /* Estilos para la imagen de fondo */
      .full-width-image {
          width: 100%;
          margin: 0;
          padding: 0;
      }
  </style>

  </head>

<body>
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
              <a class="nav-link active" aria-current="page" href="{{ route('casa') }}">Home</a>
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
                <li><a class="dropdown-item" href="{{ route('casa') }}">Ver galería</a></li>
              </ul>
            </li>
          </ul>
          <!--Boton Login Admin-->
          <form class="d-flex" role="search">
            <a href="{{ route('home') }}" class="btn btn-danger">Login</a>
          </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script></body>
</html>

