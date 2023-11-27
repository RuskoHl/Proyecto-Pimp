{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Ventas')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Listado de <span class="text-danger">Ventas</span></h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">

        </div>
        
        @if (session('alert'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tabla-ventas" class="table table-striped nowrap responsive hover display compact" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Codigo Venta</th>
                                <th scope="col" class="text-uppercase">Fecha de Emisión</th>
                                <th scope="col" class="text-uppercase">ID de Caja</th>
                                <th scope="col" class="text-uppercase">Username de Cliente</th>
                                <th scope="col" class="text-uppercase">Precio Total</th>
                                <th scope="col" class="text-uppercase">Contenido del Carrito</th>
                                <th scope="col">Acciones</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $venta)
                            <tr>
                                <td><h2 class="text-danger">{{ $venta->id }}</h2></td>
                                <td>{{ $venta->fecha_emision }}</td>
                                <td>{{ $venta->caja_id }}</td>
                                <td>{{ $venta->user ? $venta->user->name : 'N/A' }}</td>
                                <td><h5>${{ $venta->valor_total }}</h5></td>
                               
                                <td>
                                    @if ($venta->contenido)
                                        @php
                                            $carrito = json_decode($venta->contenido, true);
                                        @endphp
                                
                                        @if ($carrito && count($carrito) > 0)
                                            <ul>
                                                @foreach ($carrito as $item)
                                                    <li><h6 class="text-danger">{{ $item['name'] }}</h6> <span class="text-bold">Cantidad:<span class="text-info"> {{ $item['qty'] }}</span>,<br><span class="text-bold">Precio Unitario:</span><span class="text-info"> ${{ $item['price'] }}</span>,<br><span class="text-bold">Total:<span class="text-info"> ${{ $item['qty'] * $item['price'] }}</span>.</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-warning">No hay productos en el carrito.</p>
                                        @endif
                                    @else
                                        <p>No hay información del carrito disponible.</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-primary">Editar</a>
                                </td>
                                <td>{{ $venta->caja ? $venta->caja->nombre : 'N/A' }}</td>

                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

{{-- Importacion de Archivos CSS --}}
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@stop

{{-- Importacion de Archivos JS --}}
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></
<script src="{{ asset('js/ventas.js') }}"></script>
@stop