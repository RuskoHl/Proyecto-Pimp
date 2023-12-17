@extends('layouts.ojo')

@section('title', 'PIMP|Perfil')

@section('content')

    <div class="container mt-3 mb-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-black">
                        <h2 class="text-white">Mi Perfil</h2>
                    </div>

                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-header bg-danger">
                                <h2 class="text-white">Mi Usuario</h2>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Información del Usuario</h5>
                                <p class="card-text"><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                                <p class="card-text"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="card">
                        <div class="card-header bg-danger">
                            <h2 class="text-white">Mis Compras</h2>
                        </div>
    
                        <div class="card-body">
                                @if(isset($ventas) && !$ventas->isEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha de Emisión</th>
                                        <th>Valor Total</th>
                                        <th class="text-center">Código de Retiro</th>
                                        <!-- Otros encabezados según tus necesidades -->
                                        <th>Contenido de la compra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ventas as $venta)
                                        <tr>
                                            <td>{{ $venta->fecha_emision }}</td>
                                            <td class="text-success">${{ $venta->valor_total }}</td>
                                            <td class="text-center"> <h2 class="text-danger">{{ $venta->id }}</h2></td>
                                            <!-- Otros campos según tus necesidades -->
                                            <td>
                                                @if ($venta->contenido)
                                                    @php
                                                        $carrito = json_decode($venta->contenido, true);
                                                    @endphp
                                            
                                                    @if ($carrito && count($carrito) > 0)
                                                        <ul>
                                                            @foreach ($carrito as $item)
                                                                <li><h6 class="text-danger">{{ $item['name'] }}</h6> <span class="text-bold">Cantidad:<span class="text-info"> {{ $item['qty'] }}</span>.</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="text-warning">No hay productos en el carrito.</p>
                                                    @endif
                                                @else
                                                    <p>No hay información del carrito disponible.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            </div>
                        </div>
                            <p>No hay historial de compras.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
