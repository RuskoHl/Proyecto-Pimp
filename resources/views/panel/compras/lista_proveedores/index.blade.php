{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Proveedores')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Lista de Proveedores</h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('proveedor.create') }}" class="btn btn-success text-uppercase">
                Nuevo Proveedor
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
                <table id="tabla-proveedors" class="table table-striped nowrap responsive hover display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-uppercase">Nombre</th>
                            <th scope="col" class="text-uppercase">Email</th>
                            <th scope="col" class="text-uppercase">Telefono</th>
                            <th scope="col" class="text-uppercase">Direccion</th>
                            <th scope="col" class="text-uppercase">CUIT</th>
                            <th scope="col" class="text-uppercase">Comentario</th>
                            <th scope="col" class="text-uppercase">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedors as $proveedor)
                        <tr>
                            <td>{{ $proveedor->id }}</td>
                            <td>{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->email }}</td>
                            <td>{{ $proveedor->telefono }}</td>
                            <td>{{ $proveedor->direccion }}</td>
                            <td>{{ $proveedor->cuit }}</td>
                            <td>{{ Str::limit($proveedor->comentario, 80) }}</td>
                            
                            

                            <td>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('proveedor.show', $proveedor) }}" class="btn btn-sm btn-info text-white text-uppercase me-1 ">
                                        Ver
                                    </a>
                                    <a href="{{ route('proveedor.edit', $proveedor) }}" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                        Editar
                                    </a>

                                    <form id="deleteForm2" action="{{ route('proveedor.destroy', $proveedor) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                    </form>
                                    
                                    <button id="deleteButton2" class="btn btn-sm btn-danger text-uppercase">
                                        Eliminar
                                    </button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Cuando se hace clic en el botón de eliminar
        document.getElementById('deleteButton2').addEventListener('click', function () {
            // Mostrar SweetAlert de confirmación
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminarlo"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma, enviar el formulario de eliminación
                    document.getElementById('deleteForm2').submit();
                }
            });
        });
    });
</script>

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
    <script src="{{ asset('js/proveedors.js') }}"></script>
@stop