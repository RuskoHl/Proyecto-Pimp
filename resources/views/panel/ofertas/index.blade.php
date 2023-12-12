@extends('adminlte::page')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-bold">Listado de Ofertas</h2>
                <a href="{{ route('ofertas.create') }}" class="btn btn-sm btn-danger text-uppercase mb-2">
                    Crear Oferta
                </a>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de Finalización</th>
                                    <th>Monto de Descuento</th>
                                    <th>Productos</th> <!-- Nueva columna para mostrar productos -->
                                    <th>Status</th>
                                    <th>Acciones</th> <!-- Nueva columna para acciones -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ofertas as $oferta)
                                    <tr>
                                        <td>{{ $oferta->titulo }}</td>
                                        <td>{{ $oferta->descripcion }}</td>
                                        <td>{{ $oferta->fecha_inicio }}</td>
                                        <td>{{ $oferta->fecha_finalizacion }}</td>
                                        <td>{{ $oferta->monto_descuento }}</td>
                                        <td>{{ $oferta->productos->pluck('nombre')->implode(', ') }}</td>
                                        <td>
                                            @if($oferta->status)
                                                <span class="badge badge-success">Activa</span>
                                            @else
                                                <span class="badge badge-danger">Inactiva</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('ofertas.activate', $oferta->id) }}" class="btn btn-sm btn-success w-100" title="Activar">
                                                Activar
                                            </a>
                                            <a href="{{ route('ofertas.deactivate', $oferta->id) }}" class="btn btn-sm btn-danger w-100" title="Desactivar">
                                                Desactivar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
