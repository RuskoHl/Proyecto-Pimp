@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Productos')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Contenido del carrito</h1>
@stop

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
                </tr>
            </thead>
            <tbody>
                @foreach (Cart::content($identificadorCarrito) as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ $item->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-4">Total del Carrito: <span class="text-danger">${{ Cart::total() }}</span></h2>
@csrf

</form>

    @endif
</div>



@stop