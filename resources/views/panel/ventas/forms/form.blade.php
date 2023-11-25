<div class="card mb-5">
    <form action="{{ $venta->id ? route('ventas.update', $venta) : route('carrito.storeCarritoEnBaseDeDatos') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($venta->id)
            @method('PUT')
        @endif

        <div class="card-body">

        <!-- En el formulario de edición -->
        <div class="mb-3 row ">
            <label for="fecha_emision" class="col-sm-4 col-form-label"> * Fecha de Emisión </label>
            <div class="col-sm-8">
                <input type="" class="form-control " id="fecha_emision" name="fecha_emision" value="{{ old('fecha_emision', $venta->fecha_emision) }}">
            </div>
        </div>
        
            <div class="mb-3 row">
                <label for="valor_total" class="col-sm-4 col-form-label"> * Valor Total </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('valor_total') is-invalid @enderror" id="valor_total" name="valor_total" value="{{ old('valor_total', optional($venta)->valor_total) }}">
                    @error('valor_total')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label"> Estado </label>
                <div class="col-sm-8">
                    <select id="estado" name="estado" class="form-control">
                        <option value="retirado" {{ old('estado', optional($venta)->estado) == 'retirado' ? 'selected' : '' }}>Retirado</option>
                        <option value="enviado" {{ old('estado', optional($venta)->estado) == 'enviado' ? 'selected' : '' }}>Enviado</option>
                        <option value="entregado" {{ old('estado', optional($venta)->estado) == 'entregado' ? 'selected' : '' }}>Entregado</option>
                        <option value="en_posesion" {{ old('estado', optional($venta)->estado) == 'en_posesion' ? 'selected' : '' }}>En Posesión</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            

  

            <!-- Repite el bloque anterior para otras relaciones -->

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $venta->id ? 'Actualizar' : 'Crear' }}
            </button>
        </div>
    </form>

</div>

@push('js')
    <!-- Incluye aquí el script para la vista previa de la imagen si es necesario -->
@endpush
