<!-- video.blade.php -->
@extends('layouts.ojo')

@section('content')
    <div class="position-relative">
        <!-- Video y capa de entumecimiento -->
        <video autoplay muted loop class="w-100 mt-1" id="background-video">
            <source src="{{ asset('6.mp4') }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
        
        <!-- Capa de entumecimiento -->
        <div class="position-absolute text-center text-white w-100" id="overlay-text">
            <h1 style="font-family: 'Old English Text MT', sans-serif; font-size: 7em;">Pimp</h1>
            <p class="text-danger" style="font-family: 'Old English Text MT', sans-serif;">
                Tengo amigos con doble vida como superhéroes con alias
                Los porkis los siguen por dejar su
                Nombre en muros y las pruebas son varias
            </p>
            <div class="container mt-5">
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
            <!-- Agrega más contenido si es necesario -->
        </div>
    </div>




    
        {{-- FIN CARD PRODUCTOS --}}
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
