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
            
            <a href="{{ route('caja.create') }}" class="btn btn-success text-uppercase">
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
                <table id="tabla-cajas" class="table table-striped table-hover w-100">
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
                                    <a href="{{ route('caja.edit', $caja) }}" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                        Editar
                                    </a>
                                    <form action="{{ route('caja.destroy', $caja) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger text-uppercase">
                                            Eliminar
                                        </button>
                                    </form>
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
    
@stop


{{-- Importacion de Archivos JS --}}
@section('js')

    {{-- La funcion asset() es una funcion de Laravel PHP que nos dirige a la carpeta "public" --}}
    <script src="{{ asset('js/cajas.js') }}"></script>
@stop