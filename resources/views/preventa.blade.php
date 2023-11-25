@extends('layouts.ojo')

@section('title', 'PIMP|Preventa')

@section('content')
<div class="container mt-4">
    <div class="card m-4">
        <div class="card-header bg-black">
            <h2 class="mb-0 text-danger">LISTO!</h2>
        </div>

        <!-- Liñita -->
        <div class="container-fluid bg-danger" style="height: 5px;">
            <div class="row justify-content-center align-items-center" style="height: 100%;">
            </div>
        </div>
        <!-- Fin Liñita -->

        <div class="card-body ">
            <br>
            <h5>¡FELICIDADES COMPRA REALIZADA!</h5>
            <p>Con el código de venta Nr°: <h4>#<span class="text-danger bold">{{ session('venta') ? session('venta')->id : 'N/A' }}</span></h4>retire el producto por el local.</p>
            <br>
        </div>
    </div>
</div>

@endsection
