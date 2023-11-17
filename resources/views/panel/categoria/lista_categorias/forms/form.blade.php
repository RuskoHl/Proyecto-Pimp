<div class="card mb-5">
    <form action="{{ $categoria->id ? route('categoria.update', $categoria) : route('categoria.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($categoria->id)
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-4 col-form-label"> * Nombre </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', optional($categoria)->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $categoria->id ? 'Actualizar' : 'Crear' }}
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
