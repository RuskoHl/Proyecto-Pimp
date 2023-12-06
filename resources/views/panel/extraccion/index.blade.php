<!-- resources/views/extraccion/index.blade.php -->

@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Listado de Extracciones</h2>
        </div>
        <a href="{{ route('caja.index') }}" class="btn btn-sm btn-danger text-uppercase">
            Volver al Listado de cajas
        </a>
        <div class="card mt-3">
            
            <div class="card-body mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Razón</th>
                            <th>Caja ID</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($extracciones as $extraccion)
                            <tr>
                                <td>{{ $extraccion->id }}</td>
                                <td><span class="text-bold">{{ $extraccion->created_at }}</span></td>
                                <td class="text-danger"><span class="text-bold">{{ $extraccion->monto }}</span></td>
                                <td class="text-info"><span class="text-bold">{{ $extraccion->razon }}</span></td>
                                <td>{{ $extraccion->caja_id }}</td>
     
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
