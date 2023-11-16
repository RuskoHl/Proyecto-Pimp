@extends('adminlte::page')

@section('title', 'Ver')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <h1>Datos del Proveedor "<a class="text-danger">{{ $proveedor->nombre }}</a>"</h1>
            <a href="{{ route('proveedor.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver al Listado
            </a>
            <br><br>
            <form id="deleteForm2" action="{{ route('proveedor.destroy', $proveedor) }}" method="POST">
                @csrf 
                @method('DELETE')
            </form>
            
            <button id="deleteButton2" class="btn btn-sm btn-danger text-uppercase">
                Eliminar
            </button>
            <br><br>
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-2">
                    <div class="mb-3">    
                        <h2>Nombre: {{ $proveedor->nombre }}</h2>
                    </div>
                    <div class="mb-3">
                        <p> Mail: {{ $proveedor->email }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Telefono: {{ $proveedor->telefono }}</p>
                    </div>
                    <div class="mb-3">    
                        <p>Direccion: {{ $proveedor->direccion }}</p>
                    </div>
                    <div class="mb-3">
                        <p> CUIT: {{ $proveedor->cuit }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Comentario: {{ $proveedor->comentario }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

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
@stop
