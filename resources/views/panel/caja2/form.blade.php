@extends('adminlte::page')

@section('title', 'Editar Caja')

@section('content_header')
    <h1>Editar Caja</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('caja2.update', $caja) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Mostrar los datos de la caja -->
                    <div class="mb-3 row">
                        <label for="fecha_cierre" class="col-sm-4 col-form-label"> * Fecha Cierre </label>
                        <div class="col-sm-8">
                            <input type="datetime-local" class="form-control" id="fecha_cierre" name="fecha_cierre" value="{{ old('fecha_cierre', $caja->fecha_cierre) }}">
                        </div>
                    </div>

                    <!-- Agregar otros campos según sea necesario -->

                    <div class="mb-3 row">
                        <label for="status" class="col-sm-4 col-form-label"> * Status </label>
                        <div class="col-sm-8">
                            <label>
                                <input type="radio" name="status" value="1" {{ old('status', $caja->status) ? 'checked' : '' }}>
                                Abierto
                            </label>
                            <label>
                                <input type="radio" name="status" value="0" {{ old('status', $caja->status) ? '' : 'checked' }}>
                                Cerrado
                            </label>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success text-uppercase">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
