@extends('layouts.ojo')

@section('title', 'PIMP|Preventa')

@section('content')
<div class="container mt-4">
    <div class="card m-4">
        <div class="card-header bg-black">
            <h2 class="mb-0 text-danger">Comprar carrito</h2>
        </div>

        <!--Liñita-->
            <div class="container-fluid bg-danger" style="height: 5px;"> <!-- Ajusta la altura como desees -->
            <div class="row justify-content-center align-items-center" style="height: 100%;">
            </div>
            </div>
        <!--Fin Liñita-->

        <div class="card-body ">
            
            <form method="post" action="">
                @csrf {{-- Agrega el token CSRF para proteger el formulario contra ataques CSRF --}}
                
                {{-- Campo de Nombre --}}
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control m-1" required>
                </div>

                {{-- Campo de Apellido --}}
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control m-1" required>
                </div>

                {{-- Campo de Método de Pago --}}
                <div class="form-group">
                    <label for="metodo_pago">Método de Pago:</label>
                    <select name="metodo_pago" id="metodo_pago" class="form-control m-1" required>
                        <option value="tarjeta_credito">Tarjeta de Crédito</option>
                        <option value="paypal">PayPal</option>
                        <option value="efectivo">Efectivo</option>
                    </select>
                </div>

                <a href="">
                    total
                </a>

                {{-- Botón de Confirmar Compra --}}
                <button type="submit" class="btn btn-success m-4">Confirmar Compra</button>
            </form>
        </div>
    </div>
</div>

@endsection