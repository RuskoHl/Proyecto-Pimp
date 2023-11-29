<div class="card mb-5">
    <form action="{{ $subcategoria->id ? route('subcategoria.update', $subcategoria) : route('subcategoria.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($subcategoria->id)
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-4 col-form-label"> * Nombre </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', optional($subcategoria)->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
        
        <div class="mb-3 row">
            <label for="categoria" class="col-sm-4 col-form-label"> * Categoria </label>
            <div class="col-sm-8">
                <select id="categoria_id" name="categoria_id" class="form-control">
                    @foreach ($categorias as $categoria)
                        <option {{ $subcategoria->categoria_id && $subcategoria->categoria_id == $categoria->id ? 'selected': ''}} value="{{ $categoria->id }}"> 
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>                
            </div>
        </div>
    </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $subcategoria->id ? 'Actualizar' : 'Crear' }}
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
