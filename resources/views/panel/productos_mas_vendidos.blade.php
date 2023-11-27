@extends('adminlte::page')
@section('content')
    <div class="container">
        <h1>Productos Más Vendidos</h1>

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
@endsection