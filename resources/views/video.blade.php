@extends('layouts.ojo')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 p-0">
      <div class="video-container" style="display: flex;">
        <video style="width: 100%; max-height: 100vh; object-fit: contain; object-position: center; display: block; flex-shrink: 0;" muted autoplay loop>
          <source src="b.mp4?v=b" type="video/mp4">
          Tu navegador no soporta el tag de video.
        </video>
        <video style="width: 100%; max-height: 100vh; object-fit: contain; object-position: center; display: block; flex-shrink: 0;" muted autoplay loop>
          <source src="c.mp4?v=c" type="video/mp4">
          Tu navegador no soporta el tag de video.
        </video>
        {{-- <video style="width: 100%; max-height: 100vh; object-fit: contain; object-position: center; display: block; flex-shrink: 0;" muted autoplay loop>
          <source src="1.mp4?v=1" type="video/mp4">
          Tu navegador no soporta el tag de video.
        </video> --}}
      </div>
    </div>
    
    <div class="col-lg-4 p-0">
      <div class="video-container">
        <video style="width: 100%; max-height: 100vh; object-fit: contain; object-position: center; display: block; flex-shrink: 0;" muted autoplay loop>
          <source src="a.mp4?v=a" type="video/mp4">
          Tu navegador no soporta el tag de video.
        </video>
      </div>
    </div>
  </div>
</div>

<style>
  .video-container {
    min-width: 300px;
  }
</style>
@endsection
