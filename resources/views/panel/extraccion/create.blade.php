<!-- resources/views/extraccion/create.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row mt-3 mb-1">
            <h2>Realizar Extracción</h2>
        </div>
        <a href="{{ route('caja.index') }}" class="btn btn-sm btn-danger text-uppercase">
            Volver al Listado de cajas
        </a>
        <div class="card mt-3">
            <div class="card-body">
<form action="{{ route('extraccion.store') }}" method="post" id="extraccionForm">
    @csrf

                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto a extraer:</label>
                        <input type="number" class="form-control" name="monto" step="0.01" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="razon" class="form-label">Razón:</label>
                        <input type="text" class="form-control" name="razon" required>
                    </div>

                    <input type="hidden" name="caja_id" value="{{ $cajaActiva->id }}">
                
                    <button type="submit" class="btn btn-primary">Realizar Extracción</button>
                </form>
            </div>
        </div>
    </div>
    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Capturamos el formulario
            const extraccionForm = document.getElementById('extraccionForm');
    
            extraccionForm.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevenir el envío del formulario por defecto
    
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡Se realizará una extracción!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, realizar extracción"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si se confirma, enviar el formulario de extracción
                        extraccionForm.submit();
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
