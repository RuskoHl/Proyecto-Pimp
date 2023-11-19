@extends('adminlte::page')

@section('title', 'Ver')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <h1>Datos de la subcategoria "{{ $subcategoria->nombre }}"</h1>

            <a href="{{ route('subcategoria.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver al Listado
            </a>

            <form id="deleteForm2" action="{{ route('subcategoria.destroy', $subcategoria) }}" method="POST">
                @csrf 
                @method('DELETE')
            </form>
            
            <button id="deleteButton2" class="btn btn-sm btn-danger text-uppercase">
                Eliminar
            </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body mt-2">
                    <div class="mb-3">    
                        <h2>Nombre: {{ $subcategoria->nombre }}</h2>
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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
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
@stop
