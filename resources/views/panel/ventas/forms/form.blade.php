<div class="card mb-5">
    <form action="{{ $venta->id ? route('ventas.update', $venta) : route('ventas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($venta->id)
            @method('PUT')
        @endif

        <div class="card-body">

            <div class="mb-3 row">
                <label for="fecha_emision" class="col-sm-4 col-form-label"> * Fecha de Emisión </label>
                <div class="col-sm-8">
                    <input type="date" class="form-control @error('fecha_emision') is-invalid @enderror" id="fecha_emision" name="fecha_emision" value="{{ old('fecha_emision', optional($venta)->fecha_emision) }}">
                    @error('fecha_emision')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="iva" class="col-sm-4 col-form-label">* IVA </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('iva') is-invalid @enderror" id="iva" name="iva" value="{{ old('iva', optional($venta)->iva) }}">
                    @error('iva')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
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

            <!-- Ajusta las relaciones según tus necesidades -->
            <div class="mb-3 row">
                <label for="caja_id" class="col-sm-4 col-form-label"> * Caja </label>
                <div class="col-sm-8">
                    <select class="form-control @error('caja_id') is-invalid @enderror" id="caja_id" name="caja_id">
                        <!-- Aquí debes incluir las opciones de las cajas -->
                    </select>
                    @error('caja_id')
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
