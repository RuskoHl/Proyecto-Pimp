<div class="card mb-5">
    @php
        $cajaAbierta = App\Models\Caja::where('status', 1)->first();
    @endphp

    @if (!$cajaAbierta)
        <form id="cajaForm" action="{{ $caja->id ? route('caja.update', $caja) : route('caja.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($caja->id)
                @method('PUT')
            @endif

            <div class="card-body">
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
                            <!-- ... Otro contenido del formulario ... -->
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-1">
                            <button type="submit" class="btn btn-success text-uppercase" id="abrirButton">
                                {{ $caja->id ? 'Actualizar' : 'Abrir' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="alert alert-danger">
            Ya hay una caja abierta.
        </div>
    @endif
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const abrirButton = document.getElementById('abrirButton');
            const statusCard = document.querySelector('.border-success');

            statusCard.addEventListener('click', function() {
                // Simula el clic en el radio button de "Abrir"
                document.querySelector('input[name="status"][value="1"]').click();
            });

            abrirButton.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "¡Caja Abierta!",
                    showConfirmButton: false,
                    timer: 1500
                });

                // Aquí puedes agregar cualquier lógica adicional que necesites antes de enviar el formulario
                // ...

                // Finalmente, envía el formulario
                document.getElementById('cajaForm').submit();
            });
        });
    </script>
@endpush
