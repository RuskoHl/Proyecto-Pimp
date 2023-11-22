@extends('layouts.ojo')

@section('title', 'PIMP | Carrito')

@section('content')
    <div class="container border">
        <h1 class="mt-4 mb-4" style="font-family: 'Old English Text MT', sans-serif;">Carrito de Compras</h1>

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
                                    <button type="submit" class="btn btn-success mt-1">Actualizar</button>
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
<form action="{{ route('carrito.store') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">Comprar Carrito</button>
</form>
        @else
            <p class="mt-4">El carrito está vacío. <br><br><br><br><br><br></p>
        @endif
    </div>
@endsection