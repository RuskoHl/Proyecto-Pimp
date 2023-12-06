@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Productos')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Lista de Productos Escasos</h1>
    <a href="{{ route('producto.index') }}" class="btn btn-sm btn-danger text-uppercase">
        Volver al Listado de Productos
    </a>
@stop

@section('content')
<a href="{{ route('producto.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
    <div class="card bg-white">
        <div class="card-body">
            <h5 class="card-title"><strong class="text-danger">Cantidad Productos escasos</strong></h5>
            <p class="card-text"> Hay <strong>{{ App\Models\Producto::where('cantidad', '<', DB::raw('cantidad_minima'))->count() }}</strong> productos con un stock menor a <span class="text-info">su propia</span> cantidad mínima.</p>
        </div>
    </div>
</a>
<div class="row">
    <div class="col-12">
        <table id="productos" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Nombre</th>
                    <th>imagen</th>
                    <th>Stock Disponible</th>
                    <th>Stock Minimo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productosEscasos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>
                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-fluid" style="width: 150px;">
                        </td>
                        <td class="text-danger"><h1>{{ $producto->cantidad }}</h1></td>
                        <td class="text-info"><h3>{{ $producto->cantidad_minima }}</h3></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>
@stop