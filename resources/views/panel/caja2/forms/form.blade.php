<div class="card mb-5 ">
    @php
        $cajaAbierta = App\Models\Caja::where('status', 1)->first();
    @endphp

    @if (!$cajaAbierta)
        <form action="{{ $caja->id ? route('caja.update', $caja) : route('caja2.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($caja->id)
                @method('PUT')
            @endif

            <div class="card-body ">
                <div class="mb-3 row d-none">
                    <label for="fecha_apertura" class="col-sm-4 col-form-label"> * Fecha Apertura </label>
                    <div class="col-sm-8">
                        <input type="datetime-local" class="form-control @error('fecha_apertura') is-invalid @enderror" id="fecha_apertura" name="fecha_apertura" value="{{ old('fecha_apertura', optional($caja)->fecha_apertura) }}">
                        @error('fecha_apertura')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-none">
                    <label for="monto_inicial" class="col-sm-4 col-form-label">* Monto Inicial </label>
                    <div class="col-sm-8">
                        <input type="hidden" name="monto_inicial" value="{{ $montoFinalCajaAnterior }}">
                        @error('monto_inicial')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
                {{-- MODIFICAR A PARTIR DE AQUI --}}
                <div class="card mb-3 border border-success" style="cursor: pointer; background-color: {{ old('status', optional($caja)->status) === 'Abierto' ? '#28a745' : '' }}" onclick="selectAbrir()">
                    <div class="card-body row">
                        <div class="col-5">
                            <label for="status" class="form-label">  </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1" {{ old('status', optional($caja)->status) === 'Abierto' ? 'checked' : '' }}>
                                <label class="form-check-label"><h2 class="text-success mb-3"> <span class="text-bold">Abrir caja</span></h2></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input d-none" type="radio" name="status" value="1" {{ old('status', optional($caja)->status) === 'Cerrado' ? 'checked' : '' }}>
                            </div>
                            @error('status')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>

                        <div class="col-6 d-flex align-items-center justify-content-end ">
                            <svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 640 512" fill="green"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M58.9 42.1c3-6.1 9.6-9.6 16.3-8.7L320 64 564.8 33.4c6.7-.8 13.3 2.7 16.3 8.7l41.7 83.4c9 17.9-.6 39.6-19.8 45.1L439.6 217.3c-13.9 4-28.8-1.9-36.2-14.3L320 64 236.6 203c-7.4 12.4-22.3 18.3-36.2 14.3L37.1 170.6c-19.3-5.5-28.8-27.2-19.8-45.1L58.9 42.1zM321.1 128l54.9 91.4c14.9 24.8 44.6 36.6 72.5 28.6L576 211.6v167c0 22-15 41.2-36.4 46.6l-204.1 51c-10.2 2.6-20.9 2.6-31 0l-204.1-51C79 419.7 64 400.5 64 378.5v-167L191.6 248c27.8 8 57.6-3.8 72.5-28.6L318.9 128h2.2z"/></svg>        </div>
                        <div class="col-1">

                        </div>
                    </div>
                </div>
                {{-- MODIFICAR HASTA AQUI --}}



        <!-- Mover el botón fuera del formulario -->
        <div class="container">
            <div class="row">
                <div class="col-1 ">
                    <button type="submit" class="btn btn-success text-uppercase">
                        {{ $caja->id ? 'Actualizar' : 'Abrir' }}
                    </button>
                </div>
            </div>
        </form>
        @else
            <div class="alert alert-danger">
                Ya hay una caja abierta.
            </div>
        @endif
        </div>
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
            function changeCardColor() {
                const statusCard = document.getElementById('statusCard');
                const radioBtn = statusCard.querySelector('input[name="status"]');
                statusCard.style.backgroundColor = radioBtn.checked ? '#28a745' : '';
            }
        });
    </script>
    <script>
        function selectAbrir() {
            // Simula el clic en el radio button de "Abrir"
            document.querySelector('input[name="status"][value="1"]').click();
        }
    </script>
@endpush
@push('styles')
    <style>
        /* Estilo personalizado para el checkbox */
        .custom-checkbox .form-check-input {
            position: absolute;
            opacity: 0; /* Oculta el checkbox predeterminado */
        }

        .custom-checkbox .form-check-input + .form-check-label::before {
            content: '\2022'; /* Utiliza un círculo (puedes cambiarlo a tu símbolo preferido) */
            font-size: 1.25rem; /* Tamaño del símbolo */
            color: #007bff; /* Color del símbolo */
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
        }

        .custom-checkbox .form-check-input:checked + .form-check-label::before {
            content: '\2713'; /* Utiliza una marca de verificación cuando el checkbox está seleccionado */
        }
        .custom-svg-icon {
        fill: #28a745; /* Color 'success' de Bootstrap */
    }
    </style>
@endpush
