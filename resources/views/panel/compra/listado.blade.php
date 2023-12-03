<!-- resources/views/panel/compra/listado.blade.php -->

@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Listado de <span class="text-danger">Compras Realizadas</span></h1>
            <br>
            <div class="col-md-12">
                <a href="{{ route('compra.index') }}" class="btn btn-danger">Volver a Realizar compra</a>
            </div>
            <div class="col-md-12 mx-auto mt-2 mb-2">
                <div class="card">
                    <div class="card-body">
                        @if($compras->isEmpty())
                            <p>No hay compras realizadas.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Proveedor</th>
                                        <th>Precio de la Compra</th>
                                        <th>Fecha</th>
                                        <th>Productos</th>
                                        <th>Estado de Entrega</th>
                                        <th>Estado de Cobro</th>
                                        <th>Acciones</th>
                                        <!-- Agrega más columnas según tu modelo de datos -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($compras as $compra)
                                        <tr>
                                            <td>{{ $compra->id }}</td>
                                            <td>{{ $compra->proveedor->nombre }}</td>
                                            <td>${{ $compra->monto_total }}</td>
                                            <td>{{ $compra->created_at }}</td>
                                            <td>
                                                @foreach($compra->productos as $producto)
                                                    <span class="text-danger">{{ $producto->nombre }}</span> (Cantidad: {{ $producto->pivot->cantidad }})
                                                    <br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($compra->estatus_entrega)
                                                    <span class="badge badge-success">Recibido</span>
                                                @else
                                                    <span class="badge badge-danger">Esperando Entrega</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($compra->estatus_cobro)
                                                    <span class="badge badge-primary">Cobrado</span>
                                                @else
                                                    <span class="badge badge-warning">Esperando Cobro</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('compra.cambiar-estado-entrega', $compra->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-info btn-sm">
                                                        @if($compra->estatus_entrega)
                                                            Marcar como No Recibido
                                                        @else
                                                            Marcar como Recibido
                                                        @endif
                                                    </button>
                                                </form>
                                                <form action="{{ route('compra.cambiar-estado-cobro', $compra->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        @if($compra->estatus_cobro)
                                                            Marcar como No Cobrado
                                                        @else
                                                            Marcar como Cobrado
                                                        @endif
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
