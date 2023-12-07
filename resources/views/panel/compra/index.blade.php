@extends('adminlte::page')

@section('content')
<div class="container">
    
    <div class="row">
        <h1>Realizar compra a un <span class="text-danger">Proveedor</span>.</h1>
        <div class="col-md-12">
            <div class="">
                <a href="{{ route('compras.listado') }}" class="btn btn-danger">Ver Listado de Compras</a>
            </div>
        </div>
        <br>

        {{-- Verificar si existe al menos una caja con status=1 --}}
        @if($cajas->where('status', 1)->count() > 0)
            <div class="col-md-12 mx-auto mt-2 mb-2">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        {{-- Resto del formulario --}}
                        <form action="{{ route('compra.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="proveedor">Seleccionar Proveedor:</label>
                                <select name="proveedor" id="proveedor" class="form-control">
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Agregar una tabla para mostrar los productos del proveedor seleccionado -->
                            <div class="form-group">
                                <label>Productos del Proveedor:</label>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Precio Venta</th>
                                            <th>Seleccionar</th>
                                            <th class="d-none cantidad-header">Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productos-body">
                                        @if(isset($productos))
                                            @foreach($productos as $producto)
                                                <tr>
                                                    <td>{{ $producto->id }}</td>
                                                    <td class="text-danger">{{ $producto->nombre }}</td>
                                                    <td>{{ $producto->precio }}</td>
                                                    <td>
                                                        <input type="checkbox" class="seleccion" data-target="{{ $producto->id }}">
                                                    </td>
                                                    <td class="d-none">
                                                        <input type="number" name="cantidad[{{ $producto->id }}]" value="1" min="1">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Agregar el campo de entrada para el monto total -->
                            <div class="form-group">
                                <label for="monto_total">Monto Total de la Compra:</label>
                                <input type="number" name="monto_total" id="monto_total" class="form-control" step="0.01" required>
                            </div>

                            <button type="submit" class="btn btn-success">Realizar Compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-12 mt-2">
            <div class="alert alert-danger">
                No hay cajas disponibles con status igual a 1. No puedes realizar la compra en este momento.
            </div>
        </div>
    @endif
</div>
</div>

<!-- Agregar un script para manejar la carga dinámica de productos -->
@section('js')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function () {
        // Escuchar el evento de cambio en el campo de proveedores
        $('#proveedor').on('change', function () {
            var proveedorId = $(this).val();

            // Realizar una solicitud AJAX para obtener los productos del proveedor seleccionado
            $.ajax({
                url: '/panel/obtener-productos/' + proveedorId,
                type: 'GET',
                dataType: 'json', // Especificar que esperamos una respuesta JSON
                success: function (data) {
                    // Limpiar y agregar filas a la tabla de productos
                    $('#productos-body').empty();
                    $.each(data, function (key, value) {
                        var row = '<tr>' +
                            '<td>' + value.id + '</td>' +
                            '<td class="text-danger">' + value.nombre + '</td>' +
                            '<td>' + value.precio + '</td>' +
                            '<td><input type="checkbox" class="seleccion" data-target="' + value.id + '"></td>' +
                            '<td class="d-none"><input type="number" name="cantidad[' + value.id + ']" value="1" min="1"></td>' +
                            '</tr>';
                        $('#productos-body').append(row);
                    });
                }
            });
        });

        // Escuchar el evento de cambio en los checkboxes de selección
        $(document).on('change', '.seleccion', function () {
            var targetId = $(this).data('target');
            var cantidadInput = $('input[name="cantidad[' + targetId + ']"]');
            var cantidadHeader = $('.cantidad-header'); // Agregar esta línea

            // Mostrar u ocultar la columna de cantidad según si el checkbox está seleccionado
            cantidadInput.closest('td').toggleClass('d-none', !this.checked);
            cantidadHeader.toggleClass('d-none', !this.checked); // Agregar esta línea
        });

        // Evitar que se envíen al servidor los productos no seleccionados
        $('form').submit(function() {
            $('.seleccion:not(:checked)').each(function() {
                var targetId = $(this).data('target');
                $('input[name="cantidad[' + targetId + ']"]').prop('disabled', true);
            });
        });
        // Agregar SweetAlert para la confirmación de compra
        $('form').submit(function (e) {
                    e.preventDefault(); // Evitar que el formulario se envíe directamente

                    Swal.fire({
                        title: "Confirmar Compra",
                        text: "¿Estás seguro de realizar esta compra?",
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#28a745", // Color verde
                        cancelButtonColor: "#dc3545", // Color rojo
                        confirmButtonText: "Sí, realizar compra"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si se confirma, enviar el formulario de compra
                            $(this).unbind('submit').submit();
                        }
                    });
                });
    });
</script>
@endsection

@endsection
