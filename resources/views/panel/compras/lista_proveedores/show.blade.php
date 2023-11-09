@extends('adminlte::page')

@section('title', 'Ver')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <h1>Datos del Proveedor "{{ $proveedor->nombre }}"</h1>
            <a href="{{ route('proveedor.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver al Listado
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-2">
                    <div class="mb-3">    
                        <h2>Nombre: {{ $proveedor->nombre }}</h2>
                    </div>
                    <div class="mb-3">
                        <p> Mail: {{ $proveedor->email }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Telefono: {{ $proveedor->telefono }}</p>
                    </div>
                    <div class="mb-3">    
                        <p>Direccion: {{ $proveedor->direccion }}</p>
                    </div>
                    <div class="mb-3">
                        <p> CUIT: {{ $proveedor->cuit }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Comentarioo: {{ $proveedor->comentario }}</p>
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
