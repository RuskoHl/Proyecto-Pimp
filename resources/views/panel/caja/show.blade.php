@extends('adminlte::page')

@section('title', 'Ver')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <h1>Datos de la caja del "{{ $caja->fecha_apertura }}"</h1>
            <a href="{{ route('caja.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver al Listado
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-2">
                    <div class="mb-3">    
                        <h2>Fecha Apertura: {{ $caja->fecha_apertura }}</h2>
                    </div>
                    <div class="mb-3">
                        <p> Monto Inicial: {{ $caja->monto_inicial }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Fecha Cierre: {{ $caja->fecha_cierre }}</p>
                    </div>
                    <div class="mb-3">    
                        <p>Monto Final: {{ $caja->monto_final }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Cantidad de Ventas mientras la caja esta abierta: {{ $caja->cantidad_ventas }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Status:  @if ($caja->status === 1)
                            <span class="badge bg-primary">Abierto</span>
                        @else
                            <span class="badge bg-danger">Cerrado</span>
                        @endif</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
