@extends('layouts.ojo')

@section('content')

    <div class="container mt-5 mb-5"> <!-- Agregadas clases de margen -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Historial de compras</h2>
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
                            <p>No hay historial de compras.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
