@extends('adminlte::page')

@section('title', 'Últimos Agregados')

@section('content_header')
    <h1 >Últimos Productos Agregados</h1>
    <p class="text">Los <span class="text-danger">6</span> productos mas recientes.</p>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card bg-white">
                <div class="card-body">
                    <h5 class="card-title"><strong class="text-danger">Últimos Productos Llamados</strong></h5> <br>
                    <ul>
                        @foreach($ultimosAgregados as $producto)              
                            <li class="text-truncate">•{{ $producto->nombre }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($ultimosAgregados as $producto)
            <div class="col-md-4 mx-">
                <div class="card">
                    <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body mx">
                        <h5 class="card-text text-bold text-truncate">{{ $producto->nombre }}</h5>
                        <p class="card-text text-truncate">{{ $producto->descripcion }}</p>
                        <p class="card-text"><strong>Precio:</strong> ${{ $producto->precio }}</p>
                        <p class="card-text"><strong class="text-danger">Agregado:</strong> {{ $producto->created_at->format('d/m/Y H:i:s') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
