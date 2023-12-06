<div class="card mb-5">
    <form action="{{ $caja->id ? route('caja.update', $caja) : route('caja.store') }}" method="POST" enctype="multipart/form-data">
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
                    <input type="number" class="form-control @error('monto_inicial') is-invalid @enderror" id="monto_inicial" name="monto_inicial" rows="10" value="{{ old('monto_inicial', optional($caja)->monto_inicial) }}">
                    @error('monto_inicial')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row d-none">
                <label for="fecha_cierre" class="col-sm-4 col-form-label"> * Fecha Cierre </label>
                <div class="col-sm-8">
                    <input type="datetime-local" class="form-control @error('fecha_cierre') is-invalid @enderror" id="fecha_cierre" name="fecha_cierre" value="{{ old('fecha_cierre', optional($caja)->fecha_cierre) }}">
                    @error('fecha_cierre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="d-none mb-3 row">
                <label for="monto_final" class="col-sm-4 col-form-label"> * Monto Final </label>
                <div class="col-sm-8">
                    <tr>
                        <td>Monto Final </td>
                    </tr>
                    @error('monto_final')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row d-none">
                <label for="cantidad_ventas" class="col-sm-4 col-form-label"> * cantidad_ventas </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('cantidad_ventas') is-invalid @enderror" id="cantidad_ventas" name="cantidad_ventas" value="{{ old('cantidad_ventas', optional($caja)->cantidad_ventas) }}">
                    @error('cantidad_ventas')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>




                 {{-- Modificar desde aquí --}}
                 <div class="card mb-3">
                    <div class="card-body border border-warning" id="cerrarCajaCard">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="card-title d-none">Status</h5>
                                <div class="form-check form-check-inline d-none">
                                    <input class="form-check-input" type="radio" name="status" id="abierto" value="Abierto" {{ old('status', optional($caja)->status) == 'Abierto' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="abierto">Abierto</label>
                                </div>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="status" id="cerrado" value="Cerrado" {{ old('status', optional($caja)->status) == 'Cerrado' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cerrado"><h2 class="text-warning mb-1"> <span class="text-bold"> Cerrar caja</span></h2></label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-end ">
                                <svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 448 512" fill="orange">
                                    <path d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z"/>
                                </svg>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
                <!-- Campo oculto para manejar el cambio de estado -->
                <input type="hidden" name="cerrar_caja" id="cerrar_caja" value="">
    
                <div>
                    <button id="xd" type="submit" class="btn btn-warning text-uppercase" onclick="document.getElementById('cerrar_caja').value='1';">
                        {{ $caja->id ? 'Cerrar' : 'Crear' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cuando se hace clic en cualquier parte del card
            document.getElementById('cerrarCajaCard').addEventListener('click', function () {
                // Activar el radio de cerrar
                document.getElementById('cerrado').checked = true;
            });
    
            // Cuando se hace clic en el botón de cerrar
            document.getElementById('xd').addEventListener('click', function (e) {
                e.preventDefault(); // Evitar que el formulario se envíe directamente
    
                // Mostrar SweetAlert de confirmación
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FFD700",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, cerrar caja"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si se confirma, enviar el formulario de cerrar caja
                        document.getElementById('cerrar_caja').value = '1';
                        document.getElementById('xd').form.submit();
                    }
                });
            });
        });
    </script>
    @endpush
    