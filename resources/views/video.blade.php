<!-- video.blade.php -->
@extends('layouts.ojo')

@section('content')
    <div class="position-relative">
        <!-- Video y capa de entumecimiento -->
        <video autoplay muted loop class="w-100" id="background-video">
            <source src="{{ asset('6.mp4') }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
        
        <!-- Capa de entumecimiento -->
        <div class="position-absolute text-center text-white w-100" id="overlay-text">
            <h1 style="font-family: 'Old English Text MT', sans-serif; font-size: 7em;">Pimp</h1>
            <p class="text-secondary" style="font-family: 'Old English Text MT', sans-serif;">
                Tengo amigos con doble vida como superhéroes con alias
                Los porkis los siguen por dejar su
                Nombre en muros y las pruebas son varias
            </p>
            <!-- Agrega más contenido si es necesario -->
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
