<div class="card mb-5">
    <form action="{{ $proveedor->id ? route('proveedor.update', $proveedor) : route('proveedor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($proveedor->id)
            @method('PUT')
        @endif

        <div class="card-body">

            
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-4 col-form-label"> * Nombre </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', optional($proveedor)->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-4 col-form-label">* Mail </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" rows="10">{{ old('email', optional($proveedor)->email) }}</input>
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="telefono" class="col-sm-4 col-form-label"> * Telefono </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', optional($proveedor)->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="direccion" class="col-sm-4 col-form-label"> * Direccion </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion', optional($proveedor)->direccion) }}">
                    @error('direccion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="cuit" class="col-sm-4 col-form-label"> * CUIT </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('cuit') is-invalid @enderror" id="cuit" name="cuit" value="{{ old('cuit', optional($proveedor)->cuit) }}">
                    @error('cuit')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="comentario" class="col-sm-4 col-form-label"> * Comentario </label>
                <div class="col-sm-8">
                    <textarea class="form-control @error('comentario') is-invalid @enderror" id="comentario" name="comentario" value="{{ old('comentario', optional($proveedor)->comentario) }}"></textarea>
                    @error('comentario')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
        
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $proveedor->id ? 'Actualizar' : 'Crear' }}
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
