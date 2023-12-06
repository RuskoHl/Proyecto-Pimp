@extends('adminlte::page')

@section('content')
    <div class="container ">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 mt-5 d-flex ">
                <div class="card card-danger">
                    <div class="card-header">
                        <h4><i class="fas fa-exclamation-triangle"></i> ¡Atención!</h4>
                    </div>
                    <div class="card-body text-center">
                        <p class="text-bold">No hay una caja abierta con status 1. Abre una caja antes de realizar una compra.</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('caja2.create') }}" class="btn btn-success">Abrir Caja</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
