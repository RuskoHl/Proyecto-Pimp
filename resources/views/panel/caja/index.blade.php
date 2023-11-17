{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Cajas')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Apertura y Cierre de Cajas</h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('caja2.create') }}" class="btn btn-success text-uppercase">
                Nueva caja
            </a>
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
                <table id="tabla-cajas" class="table table-striped nowrap responsive hover display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-uppercase">fecha_apertura</th>
                            <th scope="col" class="text-uppercase">monto_inicial</th>
                            <th scope="col" class="text-uppercase">fecha_cierre</th>
                            <th scope="col" class="text-uppercase">monto_final</th>
                            <th scope="col" class="text-uppercase">cantidad_ventas</th>
                            <th scope="col" class="text-uppercase">Status</th>
                            <th scope="col" class="text-uppercase">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cajas as $caja)
                        <tr>
                            <td>{{ $caja->id }}</td>
                            <td>{{ $caja->fecha_apertura }}</td>
                            <td>{{ $caja->monto_inicial }}</td>
                            <td>{{ $caja->fecha_cierre }}</td>
                            <td>{{ $caja->monto_final }}</td>
                            <td>{{ $caja->cantidad_ventas }}</td>
                            
                            <td>
                                @if ($caja->status === 1)
                                    <span class="badge bg-primary">Abierto</span>
                                @else
                                    <span class="badge bg-danger">Cerrado</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('caja.show', $caja) }}" class="btn btn-sm btn-info text-white text-uppercase me-1 ">
                                        Ver
                                    </a>


                                </div>
                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new DataTable('#tabla-proveedors', {
            responsive: true
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    {{-- La funcion asset() es una funcion de Laravel PHP que nos dirige a la carpeta "public" --}}
    <script src="{{ asset('js/cajas.js') }}"></script>
@stop