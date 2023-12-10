@extends('adminlte::page')

@section('title', 'Restar Cantidad')

@section('content_header')
    <h1>Restar Cantidad de <span class="text-danger font-weight-bold"> {{ $producto->nombre }} </span></h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('producto.index') }}" class="btn btn-sm btn-dark text-uppercase mb-2">
                Volver al Listado
            </a> 
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Formulario para Restar Cantidad - <span class="text-dark font-weight-bold"> {{ $producto->nombre }} </span></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('producto.restar-cantidad', $producto->id) }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="cantidadARestar" class="col-sm-4 col-form-label">Cantidad a Restar</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="cantidadARestar" name="cantidadARestar" min="1" max="{{ $producto->cantidad }}" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-danger">Restar Cantidad</button>
                                <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
@stop

@section('js')

@stop
