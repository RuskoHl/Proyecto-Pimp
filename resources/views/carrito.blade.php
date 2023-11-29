@extends('layouts.ojo')

@section('title', 'PIMP | Carrito')

@section('content')
    <div class="container border">
        <h1 class="mt-4 mb-4" style="font-family: 'Old English Text MT', sans-serif;">Carrito de Compras</h1>
        <!-- Añade este botón donde desees en tu aplicación -->
        @auth
        <a href="{{ route('historial.compras') }}" class="btn btn-danger">Ver Historial de Compras</a>
        @endauth
    

        @if (Cart::count() > 0)
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <form action="{{ route('carrito.actualizar', $item->rowId) }}" method="POST">
                                    @csrf
                                    <input type="number" name="cantidad" value="{{ $item->qty }}" min="1" class="form-control">
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                    <button onclick="Swal.fire('Actualizando todo el carrito...')" type="submit" class="btn btn-success mt-1">Actualizar</button>
                                </form>
                            </td>
                            <td>${{ $item->price }}</td>
                            <td>${{ $item->total }}</td>
                            <td>
                                <form action="{{ route('carrito.remover', $item->rowId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2 class="mt-4">Total del Carrito: <span class="text-danger">${{ Cart::total() }}</span></h2>

            <!-- Botón "Realizar Compra" -->
            <!-- Botón "Guardar Carrito" -->
            <form action="{{ route('carrito.store') }}" method="POST" id="comprarCarritoForm">
                @csrf
                <button type="button" class="btn btn-success" id="comprarCarritoBtn">Comprar Carrito</button>
            </form>
        @else
            <p class="mt-4">El carrito está vacío. <br><br><br><br><br><br></p> </span>
        @endif
    </div>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Asigna el evento click al botón
            document.getElementById('comprarCarritoBtn').addEventListener('click', function () {
                // Muestra la alerta SweetAlert
                Swal.fire({
                    title: "¿Estas seguro que quieres comprar esto?",
                    html: `El precio total del carrito es: <strong>${{ Cart::total() }}</strong>.<br><span style="color: red;">Deberás buscar esto en <strong>48</strong> horas por el local.</span>`,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#4CAF50", // Este es el color verde
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Quiero comprarlo!!"
                }).then((result) => {
                    // Si el usuario confirma, realiza la acción del formulario
                    if (result.isConfirmed) {
                        document.getElementById('comprarCarritoForm').submit();
                    }
                });
            });
        });
    </script>
@endsection
