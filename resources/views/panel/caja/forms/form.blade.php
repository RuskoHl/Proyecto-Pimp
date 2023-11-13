<div class="card mb-5">
    <form action="{{ $caja->id ? route('caja.update', $caja) : route('caja.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($caja->id)
            @method('PUT')
        @endif

        <div class="card-body">

            
            <div class="mb-3 row">
                <label for="fecha_apertura" class="col-sm-4 col-form-label"> * Fecha Apertura </label>
                <div class="col-sm-8">
                    <input type="datetime-local" class="form-control @error('fecha_apertura') is-invalid @enderror" id="fecha_apertura" name="fecha_apertura" value="{{ old('fecha_apertura', optional($caja)->fecha_apertura) }}">
                    @error('fecha_apertura')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="monto_inicial" class="col-sm-4 col-form-label">* Monto Inicial </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('monto_inicial') is-invalid @enderror" id="monto_inicial" name="monto_inicial" rows="10">{{ old('monto_inicial', optional($caja)->monto_inicial) }}</input>
                    @error('monto_inicial')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="fecha_cierre" class="col-sm-4 col-form-label"> * Fecha Cierre </label>
                <div class="col-sm-8">
                    <input type="datetime-local" class="form-control @error('fecha_cierre') is-invalid @enderror" id="fecha_cierre" name="fecha_cierre" value="{{ old('fecha_cierre', optional($caja)->fecha_cierre) }}">
                    @error('fecha_cierre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="monto_final" class="col-sm-4 col-form-label"> * Monto Final </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('monto_final') is-invalid @enderror" id="monto_final" name="monto_final" value="{{ old('monto_final', optional($caja)->monto_final) }}">
                    @error('monto_final')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="cantidad_ventas" class="col-sm-4 col-form-label"> * cantidad_ventas </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('cantidad_ventas') is-invalid @enderror" id="cantidad_ventas" name="cantidad_ventas" value="{{ old('cantidad_ventas', optional($caja)->cantidad_ventas) }}">
                    @error('cantidad_ventas')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="status" class="col-sm-4 col-form-label"> * Status </label>
                <div class="col-sm-8">
                    <label>
                        <input type="radio" name="status" value="1" {{ old('status', optional($caja)->status) === 'Abierto' ? 'checked' : '' }}>
                        Abierto
                    </label>
                    <label>
                        <input type="radio" name="status" value="0" {{ old('status', optional($caja)->status) === 'Cerrado' ? 'checked' : '' }}>
                        Cerrado
                    </label>
                    @error('status')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            
        
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $caja->id ? 'Actualizar' : 'Crear' }}
            </button>
        </div>
    </form>

</div>

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const image = document.getElementById('imagen');
        
            image.addEventListener('change', (e) => {

                const input = e.target;
                const imagePreview = document.querySelector('#image_preview');
                
                if(!input.files.length) return

                file = input.files[0];
                objectURL = URL.createObjectURL(file);
                imagePreview.src = objectURL;
            });
        });
    </script>
@endpush
