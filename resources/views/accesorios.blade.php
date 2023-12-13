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
      <div class="scrollable-div border-white style="overflow-x: hidden;"">
      <!-- Contenido del col-9 sin bordes -->
<!-- Contenido del PRODUCTO (CARD) -->


<!-- CARDS -->

<div class="container mt-4">
  <div class="row">
    @foreach ($productos as $producto)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
          <div class="row no-gutters">
            <div class="col-12">
              <img src="{{ $producto->imagen }}" class="card-img" alt="Producto" style="max-width:100%; height: auto;">
            </div>
            <div class="col-12">
              <div class="card-body">
                  <h4 class="card-title limit-text-titulo text-danger">
                      @if ($producto->oferta && $producto->oferta->status == 1)
                          <span class="badge badge-info">Oferta</span>
                      @endif
                      {{ $producto->nombre }}
                  </h4>

                <p class="card-text limit-text-titulo text-secondary">{{ $producto->descripcion }}</p>

                <div class="row">
                  <div class="col-8">
                    @if ($producto->oferta_id > 0 && $producto->oferta && $producto->oferta->status == 1)
                      <h4 class="card-text limit-text text-danger">
                        <del>${{ $producto->precio }}</del> <!-- Precio tachado --> <br>
                        <span class="text-info font-weight-bold">${{ $producto->precio_ofertado }}</span> <!-- Precio de oferta -->
                      </h4>
                    @else
                      <h4 class="card-text limit-text text-danger">${{ $producto->precio }}</h4>
                    @endif
                  </div>
                  <div class="col-4">
                    {{-- Comienzo row botones --}}
                      <div class="row">
                        <div class="col-5">
                          <form action="{{ route('carrito.agregar', ['id' => $producto->id]) }}" method="POST" class="d-flex">
                            @csrf
                            <input class="d-none" type="text" id="cantidad" value="1" name="cantidad" maxlength="2" />
                            <button onclick="Swal.fire('Se agregó 1 al carrito!')" type="submit" class="btn mb-4" style="background: none; border: none;">
                              <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="red">
                                <!-- Font Awesome icono de carrito -->
                                <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                              </svg>
                            </button>
                          </form>
                        </div>
                        <div class="col-5">
                          <a href="{{ route('mostrarProducto', ['id' => $producto->id]) }}" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="red">
                              <!-- Font Awesome icono de ojo -->
                              <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                            </svg>
                          </a>
                        </div>
                        <div class="col-2"></div>
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
  <!-- FIN CARDS -->
  

      </div>
</div>
</div>

    </div>
  </div>
</div>


@endsection