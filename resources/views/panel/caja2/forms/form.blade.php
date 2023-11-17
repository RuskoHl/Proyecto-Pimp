<div class="card mb-5">
    @php
        $cajaAbierta = App\Models\Caja::where('status', 1)->first();
    @endphp

    @if (!$cajaAbierta)
        <form action="{{ $caja->id ? route('caja.update', $caja) : route('caja2.store') }}" method="POST" enctype="multipart/form-data">
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
                        <input type="number" placeholder="{{ old('monto_inicial', optional($caja)->monto_inicial) }}" class="form-control @error('monto_inicial') is-invalid @enderror" id="monto_inicial" name="monto_inicial" rows="10">
                        @error('monto_inicial')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="status" class="col-sm-4 col-form-label"> * Status </label>
                    <div class="col-sm-8">
                        <label>
                            <input type="radio" name="status" value="1" {{ old('status', optional($caja)->status) === 'Abierto' ? 'checked' : '' }}>
                            Abrir
                        </label>
                        <label>
                            <input class="d-none" type="radio" name="status" value="1" {{ old('status', optional($caja)->status) === 'Cerrado' ? 'checked' : '' }}>
                            
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
    @else
        <div class="alert alert-danger">
            Ya hay una caja abierta.
        </div>
    @endif
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
