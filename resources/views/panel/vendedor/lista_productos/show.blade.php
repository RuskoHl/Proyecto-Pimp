@extends('adminlte::page')

@section('title', 'Ver')

@section('content_header')
    
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <h1>Datos del Producto "<a class="text-danger">{{ $producto->nombre }}</a>"</h1>
            <a href="{{ route('producto.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver al Listado
            </a>
            <br><br>
            <form id="deleteForm" action="{{ route('producto.destroy', $producto) }}" method="POST">
                @csrf 
                @method('DELETE')
            </form>
            
            <button id="deleteButton" class="btn btn-sm btn-danger text-uppercase">
                Eliminar
            </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" id="image_preview" class="img-fluid" style="object-fit: cover; object-position: center; height: 420px; width: 100%;">
                    </div>
                    <div class="mb-3">    
                        <h2>Nombre: {{ $producto->nombre }}</h2>
                    </div>
                    <div class="mb-3">
                        <p> Descripción: {{ $producto->descripcion }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Precio: {{ $producto->precio }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Categoria: {{ $producto->categoria->nombre }}</p>
                    </div>
                    <div class="mb-3">
                        <p>Cantidad minima: {{ $producto->cantidad_minima }}.</p>
                    </div>
                    <div class="mb-3">
                        <p>Cantidad disponible: {{ $producto->cantidad }}.</p>
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        new DataTable('#tabla-productos', {
            responsive: true
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Cuando se hace clic en el botón de eliminar
        document.getElementById('deleteButton').addEventListener('click', function () {
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
                    document.getElementById('deleteForm').submit();
                }
            });
        });
    });
</script>
@stop