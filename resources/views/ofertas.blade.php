@extends('layouts.ojo')

@section('content')
    {{-- Video --}}
    <div class="position-relative mt-1">
        <!-- Video y capa de entumecimiento -->
        <video autoplay muted loop class="w-100" id="background-video" style="height: 400px; width: 100%; object-fit: cover;">
            <source src="{{ asset('2.mp4') }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>

        <!-- Capa de entumecimiento -->
        <div class="position-absolute text-center text-white w-100" id="overlay-text">
            <h1 style="font-family: 'Old English Text MT', sans-serif; font-size: 7em;">Ofertas</h1>
            <p class="text-danger" style="font-family: 'Old English Text MT', sans-serif;">Ofertas en Pimp.</p>
        </div>
    </div>
    <!-- Línea -->
    <div class="container-fluid bg-black" style="height: 5px;"> <!-- Ajusta la altura como desees -->
        <div class="row justify-content-center align-items-center" style="height: 100%;"></div>
    </div>
    <!-- Fin Línea -->

    <div class="col-md-11 mx-auto">
        <div class="card mt-3 mb-3 border border-black">
            <div class="card-header bg-black">
                <h1 class="text-white" style="font-family: 'Old English Text MT', sans-serif;">Ofertas Disponibles</h1>
            </div>
            <div class="card-body">
                @foreach($ofertas->sortBy('monto_descuento') as $oferta)
                    <div class="mb-4">
                        <div class="card mt-1 mb-2 border border-white">
                            <div class="card-body">
                                <h2>
                                    Oferta:
                                    <span class="text-danger">{{ $oferta->titulo }}</span><br>
                                    Descuento:
                                    <span class="text-danger">{{ $oferta->monto_descuento }}%</span>
                                </h2>
                                -
                                <p class="text-danger"><span style="font-weight: bold;">{{ $oferta->descripcion }}</span></p>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($oferta->productos as $producto)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                                            <p class="card-text limit-text-titulo text-secondary">{{ $producto->descripcion }}</p>
                                            <p class="card-text">Precio Original: ${{ $producto->precio }}</p>
                                            <h4 class="card-text text-danger">Precio Ofertado: ${{ $producto->precio_ofertado }}</h4>

                                            <div class="card m-1">
                                                <a href="{{ route('mostrarProducto', ['id' => $producto->id]) }}" class="btn ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="red">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Línea -->
                    <div class="container-fluid bg-black mb-4" style="height: 2px;"> <!-- Ajusta la altura como desees -->
                        <div class="row justify-content-center align-items-center" style="height: 100%;"></div>
                    </div>
                    <!-- Fin Línea -->
                @endforeach
            </div>
        </div>
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
            var verticalPosition = (windowHeight - textHeight) / 4; // Cambié el divisor a 3
            $('#overlay-text').css('top', verticalPosition + 'px');
        }
    </script>
@endsection
