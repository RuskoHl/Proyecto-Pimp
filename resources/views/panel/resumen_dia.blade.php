@extends('layouts.app')

@section('content')
    <h1>Resumen del Día</h1>

    <a href="{{ route('producto.index') }}">
        <div class="card bg-white">
            <div class="card-body">
                <h5 class="card-title"><strong class="text-danger">Cantidad de Ventas del Día</strong></h5>
                <p class="card-text">Hoy se realizaron <strong>{{ $ventasDelDia }}</strong> ventas.</p>
            </div>
        </div>
    </a>

    <a href="{{ route('caja.index') }}">
        <div class="card bg-white">
            <div class="card-body">
                <h5 class="card-title"><strong class="text-danger">Monto Total Agregado a Caja del Día</strong></h5>
                <p class="card-text">El monto total agregado a la caja hoy es de <strong>${{ $montoCajaDelDia }}</strong>.</p>
            </div>
        </div>
    </a>
@endsection
