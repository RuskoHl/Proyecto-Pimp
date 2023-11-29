<div class="card mb-5">
    <form action="{{ $empleado->id ? route('empleado.update', $empleado) : route('empleado.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($empleado->id)
            @method('PUT')
        @endif

        <div class="card-body">

            
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-4 col-form-label"> * Nombre </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', optional($empleado)->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="apellido" class="col-sm-4 col-form-label">* Apellido </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" rows="10" value="{{ old('apellido', optional($empleado)->apellido) }}">
                    @error('apellido')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="dni" class="col-sm-4 col-form-label"> * DNI </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" value="{{ old('dni', optional($empleado)->dni) }}">
                    @error('dni')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="domicilio" class="col-sm-4 col-form-label"> * Domicilio </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('domicilio') is-invalid @enderror" id="domicilio" name="domicilio" value="{{ old('domicilio', optional($empleado)->domicilio) }}">
                    @error('domicilio')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="telefono" class="col-sm-4 col-form-label"> * Telefono </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', optional($empleado)->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="correo" class="col-sm-4 col-form-label"> * Correo </label>
                <div class="col-sm-8">
                    <textarea class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo', optional($empleado)->correo) }}"></textarea>
                    @error('correo')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
        
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $empleado->id ? 'Actualizar' : 'Crear' }}
            </button>
        </div>
    </form>
</div>

@push('js')
    <script src="{{ asset('js/empleados.js') }}"></script>
@endpush
