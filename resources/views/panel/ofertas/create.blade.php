<!-- resources/views/panel/ofertas/create.blade.php -->

@extends('adminlte::page')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-bold">Crear Oferta</h2>
                <a href="{{ route('ofertas.index') }}" class="btn btn-sm btn-danger text-uppercase mb-2">
                    Listado Ofertas
                </a>
                <form action="{{ route('ofertas.store') }}" method="post">
                    @csrf
                    <!-- Primer card para la creación de ofertas -->
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h4 class="mb-0"><span class="text-white font-weight-bold"> Datos de la Oferta:</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título:</label>
                                <input type="text" class="form-control" name="titulo" id="titulo">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
                                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                            </div>
                            <div class="mb-3">
                                <label for="fecha_finalizacion" class="form-label">Fecha de Finalización:</label>
                                <input type="date" class="form-control" name="fecha_finalizacion" id="fecha_finalizacion">
                            </div>
                        </div>
                    </div>

                    <!-- Segundo card para el listado de productos en una tabla -->
                    <div class="card mt-3">
                        <div class="card-header bg-dark text-white">
                            <h4 class="mb-0"><span class="text-white font-weight-bold"> Productos a ofertar: </span></h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productos as $producto)
                                            <tr>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>
                                                    <input type="checkbox" name="productos[]" value="{{ $producto->id }}" class="form-check-input">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tercer card para el monto de la oferta -->
                    <div class="card mt-3">
                        <div class="card-header bg-danger text-white">
                            <h4 class="mb-0"><span class="text-white font-weight-bold"> Monto de la oferta: </span></h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="monto_descuento" class="form-label">Monto a descontar (%):</label>
                                <input type="number" class="form-control" name="monto_descuento" id="monto_descuento">
                            </div>
                        </div>
                    </div>

                    <!-- Cuarto card para otros campos del formulario -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <button type="submit" class="btn btn-danger">Guardar Oferta</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
