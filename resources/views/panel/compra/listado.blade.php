@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Listado de <span class="text-danger">Compras Realizadas</span></h1>
            <br>
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-info">
                        {{ session('error') }}
                    </div>
                @endif

                <a href="{{ route('compra.index') }}" class="btn btn-danger">Volver a Realizar compra</a>
            </div>
            <div class="col-md-12 mx-auto mt-2 mb-2">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><span class="text-white font-weight-bold"> Compras registradas </span></h4>
                    </div>
                    <div class="card-body">
                        @if($compras->isEmpty())
                            <p>No hay compras realizadas.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Proveedor</th>
                                        <th>Precio de la Compra</th>
                                        <th>Fecha</th>
                                        <th>Productos</th>
                                        <th>Estado de Entrega</th>
                                        <th>Estado de Cobro</th>
                                        <th>Acciones</th>
                                        <!-- Agrega más columnas según tu modelo de datos -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($compras as $compra)
                                        <tr>
                                            <td>{{ $compra->id }}</td>
                                            <td>{{ $compra->proveedor->nombre }}</td>
                                            <td>${{ $compra->monto_total }}</td>
                                            <td>{{ $compra->created_at }}</td>
                                            <td>
                                                @foreach($compra->productos as $producto)
                                                    <span class="text-danger">{{ $producto->nombre }}</span> (Cantidad: {{ $producto->pivot->cantidad }})
                                                    <br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($compra->estatus_entrega)
                                                    <span class="badge badge-success">Recibido</span>
                                                @else
                                                    <span class="badge badge-danger">Esperando Entrega</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($compra->estatus_cobro)
                                                    <span class="badge badge-success">Cobrado</span>
                                                @else
                                                    <span class="badge badge-danger">Esperando Cobro</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form id="form-entrega-{{ $compra->id }}" action="{{ route('compra.cambiar-estado-entrega', $compra->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-info btn-sm">
                                                        @if($compra->estatus_entrega)
                                                            No Recibido
                                                        @else
                                                            Marcar como Recibido
                                                        @endif
                                                    </button>
                                                </form>
                                            
                                                @if(!$compra->estatus_cobro)
                                                    <form id="form-cobro-{{ $compra->id }}" action="{{ route('compra.cambiar-estado-cobro', $compra->id) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Marcar como Cobrado
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmarCobro(compraId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Este proceso es irreversible. ¿Deseas marcar la compra como cobrada?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, cobrar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Corregir el id del formulario para cambiar el estado de cobro
                    document.getElementById('form-cobro-' + compraId).submit();
                }
            });
        }
    </script>
    @endpush
@endsection
