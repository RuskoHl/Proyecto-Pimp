@extends('layouts.ojo')

@section('title', 'PIMP | DetallesProductos')

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Detalles del Producto: <span class="text-danger">{{ $producto->nombre }}</span></h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mt-2 d-none d-md-block">
                        <!-- Esta columna se mostrará solo en pantallas grandes -->
                        <!-- Puedes ajustar la clase "d-md-block" según tus necesidades -->
                    </div>
                    <div class="col-md-5 mt-3">
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid float-left mr-3">
                    </div>
                    <div class="col-md-5 mt-3">
                        <h2>{{ $producto->nombre }}</h2>
                        <p class="text-muted">{{ $producto->descripcion }}</p>
                        <h2>Precio: <span class="text-danger font-weight-bold">${{ $producto->precio }}</span></h2>
                        <p class="text-bold">Cantidad disponible:<span class="text-info"> {{ $producto->cantidad }}</span></p>
                        <p class="text-bold">Categoria:<span class="text-info"> {{ $producto->categoria->nombre }}</span></p>
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
                            <input type="text" id="cantidad" value="1" name="cantidad" maxlength="2" class="d-none"/>
                            <button onclick="Swal.fire('Añadiendo al carrito!')" type="submit" class="btn mb-4" style="background: none; border: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="red" class="bi bi-cart-check" viewBox="0 0 16 16">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" fill="red" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
