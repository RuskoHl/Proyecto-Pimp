<!-- video.blade.php -->
@extends('layouts.ojo')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Div grande a la derecha -->
        <div class="col-lg-9">
            <div class="video-container">
                <!-- Puedes incluir un video aquí -->
                <video id="video1" style="width: 100%; height: 100%; object-fit: cover;" muted autoplay>
                    <source src="1.mp4" type="video/mp4">
                    Tu navegador no soporta el tag de video.
                </video>
            </div>
        </div>

        <!-- Div arriba del otro a la izquierda -->
        <div class="col-lg-3">
            <div class="video-container">
                <!-- Puedes incluir otro video aquí -->
                <video id="video2" style="width: 100%; height: 100%; object-fit: cover;" muted autoplay>
                    <source src="1.mp4" type="video/mp4">
                    Tu navegador no soporta el tag de video.
                </video>
            </div>
            <div class="video-container mt-3">
                <!-- Y otro video aquí -->
                <video id="video3" style="width: 100%; height: 100%; object-fit: cover;" muted autoplay>
                    <source src="1.mp4" type="video/mp4">
                    Tu navegador no soporta el tag de video.
                </video>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        // Reproducir videos después de la carga de la página
        document.getElementById('video1').play();
        document.getElementById('video2').play();
        document.getElementById('video3').play();
    }, 1000); // Esperar 1 segundo (ajusta el tiempo según sea necesario)
});

</script>
@endsection
