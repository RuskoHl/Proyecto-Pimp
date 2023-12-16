@extends('layouts.ojo')

@section('title', 'PIMP | Carrito')

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header bg-black text-white">
                <h1 class="card-title" style="font-family: 'Old English Text MT', sans-serif;">Carrito de Compras</h1>
            </div>
            <div class="card-body">
                @auth
                    <a href="{{ route('historial.compras') }}" class="btn btn-danger mb-3">Ver Historial de Compras</a>
                @endauth

                @if (Cart::count() > 0)
                    <table class="table">
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
                                        <div class="mt-1">
                                            <button onclick="Swal.fire('Actualizando todo el carrito...')" type="submit" class="btn btn-success">Actualizar</button>
                                        </div>
                                    </form>
                        
                                    <form action="{{ route('carrito.remover', $item->rowId) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-2">Eliminar</button>
                                    </form>
                                </td>
                                <td>${{ $item->price }}</td>
                                <td>${{ $item->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h2 class="mt-4">Total del Carrito: <span class="text-danger">${{ Cart::total() }}</span></h2>

                    <!-- Botón "Realizar Compra" -->
                    <form action="{{ route('carrito.crearCarritoYRedirigir') }}" method="POST" id="comprarCarritoForm">
                        @csrf
                        <button type="button" class="btn btn-success" id="comprarCarritoBtn">Realizar Compra</button>
                    </form>
                    
                    <!-- Botón "Guardar Carrito" -->
                    {{-- <form action="{{ route('carrito.guardar') }}" method="POST" id="guardarCarritoForm">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-2">Guardar Carrito</button>
                    </form> --}}
                @else
                    <p class="mt-4">El carrito está vacío.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('comprarCarritoBtn').addEventListener('click', function () {
                Swal.fire({
                    title: "¿Estas seguro que quieres comprar esto?",
                    html: `El precio total del carrito es: <strong>${{ Cart::total() }}</strong>.<br><span style="color: red;">Deberás buscar esto en <strong>48</strong> horas por el local.</span>`,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#4CAF50",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Quiero comprarlo!!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('comprarCarritoForm').submit();
                    }
                });
            });
        });
    </script>
@endsection
