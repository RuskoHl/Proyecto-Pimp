@extends('layouts.ojo')

@section('title', 'PIMP|DetallesProductos')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-9">
    <!--Tarjeta de contenido de Producto-->
            <div class="row">
                <div class="col-md-2 mt-2"></div>
                <div class="col-md-5 mt-3">
                    <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid">
                </div>
                <div class="col-md-5 mt-3">
                    <h2>{{ $producto->nombre }}</h2>
                    <p class="text-muted">{{ $producto->descripcion }}</p>
                    <h2>Precio: <span class="text-danger font-weight-bold">${{ $producto->precio }}</span></h2>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-7"></div>
                <div class="col-md-2">
                    <h3 class="text-danger font-weight-bold">Agregar al carrito -> </h3>
                </div>
                    <div class="col-md-3">    
                        <form action="{{ route('carrito.agregar', ['id' => $producto->id]) }}" method="POST">
                            @csrf
                            <input type="text" id="cantidad" value="1" name="cantidad" maxlength="2"  class="d-none"/>
                            <button onclick="Swal.fire('Añadiendo al carrito!')" type="submit" class="btn mb-4" style="background: none; border: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="red" class="bi bi-cart-check" viewBox="0 0 16 16">
                                    <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </button>
                        </form>
                        
                  
                    {{-- <a href="#" class="btn mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="red" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg></a> --}}
                    
                </div>
            </div>
    <!--Pupu -->
        </div>
    </div>
</div>
@endsection