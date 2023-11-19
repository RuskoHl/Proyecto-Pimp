@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'subcategoria')

@section('content_header')
    <h1>Lista de subcategorias</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('subcategoria.create') }}" class="btn btn-success text-uppercase">
                Nueva subcategoria
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
                    <table id="tabla-subcategorias" class="table table-striped nowrap responsive hover display compact" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-uppercase">Nombre</th>
                                <th scope="col" class="text-uppercase">Categoría</th>
                                <th scope="col" class="text-uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategorias as $subcategoria)
                                <tr>
                                    <td>{{ $subcategoria->id }}</td>
                                    <td>{{ $subcategoria->nombre }}</td>
                                    <td>
                                        @if ($subcategoria->categoria)
                                            {{ $subcategoria->categoria->nombre }}
                                        @else
                                            Sin categoría
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('subcategoria.show', $subcategoria) }}" class="btn btn-sm btn-info text-white text-uppercase me-1">
                                                Ver
                                            </a>
                                            <a href="{{ route('subcategoria.edit', $subcategoria) }}" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                                Editar
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
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('js/subcategorias.js') }}"></script>

<script>
    new DataTable('#tabla-subcategorias', {
        responsive: true,
        columns: [
            null,
            null,
            null,
            null
        ]
    });
</script>
@stop
