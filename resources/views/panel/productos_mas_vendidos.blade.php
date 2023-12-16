@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Productos Más Vendidos</h1>
        </div>
        <a href="{{ route('producto.index') }}" class="btn btn-sm btn-danger text-uppercase">
            Volver al Listado de productos
        </a>
        <a href="{{ route('ventas.index') }}" class="btn btn-sm btn-info text-uppercase">
            Volver al Listado de Ventas
        </a>
        <div class="card m-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Producto</th>
                            {{-- <th>imagen</th> --}}
                            <th>Cantidad Vendida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productosMasVendidos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td><h5 class="text-danger">{{ $producto->nombre }}</h5></td>
                                {{-- <td>
                                    <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid" style="width: 150px;">
                                </td> --}}
                                <td><h2 class="text-info">{{ $producto->cantidad_vendida }}</h2></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
