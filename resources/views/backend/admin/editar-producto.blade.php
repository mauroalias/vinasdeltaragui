<x-admin-layout title="Editar Producto">

<div class="container py-5">

    <div class="mb-5 text-center">
        <h1 class="fw-bold">Modificación de Productos</h1>
        <p class="text-muted mb-0">Edita los datos de los productos activos de la tienda</p>
    </div>

    <form action="/admin/productos/{{ $producto->id }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    @method('PUT')

        <div class="row">
            {{-- Nombre --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text" name="nombre" class="form-control rounded-3 @error('nombre') is-invalid @enderror" value="{{ old('nombre', $producto->nombre) }}" required>
                @error('nombre')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Categoría --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Categoría</label>
                <select name="categoria_id" class="form-select rounded-3 @error('categoria_id') is-invalid @enderror">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Precio --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control rounded-3 @error('precio') is-invalid @enderror" value="{{ old('precio', $producto->precio) }}" required>
                @error('precio')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Stock --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Stock</label>
                <input type="number" name="stock" class="form-control rounded-3 @error('stock') is-invalid @enderror" value="{{ old('stock', $producto->stock) }}" required>
                @error('stock')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="col-12 mb-3">
                <label class="form-label fw-semibold">Descripción</label>
                <textarea name="descripcion" class="form-control rounded-3 @error('descripcion') is-invalid @enderror" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Imagen Actual --}}
            @if($producto->url_imagen)
                <div class="col-12 mb-3">
                    <label class="form-label fw-semibold">Imagen actual</label>
                    <div class="mt-2">
                        <img src="{{ str_starts_with($producto->url_imagen, 'img/') ? asset($producto->url_imagen) : asset('img/' . $producto->url_imagen) }}"
                             class="img-fluid rounded shadow-sm border"
                             style="max-height:200px; object-fit:contain;"
                             alt="Imagen actual">
                    </div>
                </div>
            @endif

            {{-- Nueva Imagen --}}
            <div class="col-12 mb-4">
                <label class="form-label fw-semibold">Seleccionar nueva imagen</label>
                <input class="form-control rounded-3 @error('url_imagen') is-invalid @enderror" type="file" name="url_imagen" id="imagenProducto" accept=".jpg, .jpeg, .png, .webp">
                
                @error('url_imagen')
                    <div class="invalid-feedback fw-semibold d-block">{{ $message }}</div>
                @enderror

                <div class="mt-3">
                    <img id="previewNueva" class="img-fluid rounded shadow-sm border" style="max-height:200px; object-fit:contain; display:none;">
                </div>
            </div>

            {{-- Origen --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Origen</label>
                <input type="text" name="origen" class="form-control rounded-3 @error('origen') is-invalid @enderror" value="{{ old('origen', $producto->origen) }}">
                @error('origen')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Bodega --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Bodega</label>
                <input type="text" name="bodega" class="form-control rounded-3 @error('bodega') is-invalid @enderror" value="{{ old('bodega', $producto->bodega) }}">
                @error('bodega')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Graduación --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Graduación</label>
                <input type="text" name="graduacion" class="form-control rounded-3 @error('graduacion') is-invalid @enderror" value="{{ old('graduacion', $producto->graduacion) }}">
                @error('graduacion')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Volumen --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Volumen</label>
                <input type="text" name="volumen" class="form-control rounded-3 @error('volumen') is-invalid @enderror" value="{{ old('volumen', $producto->volumen) }}">
                @error('volumen')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Variedad --}}
            <div class="col-12 mb-4">
                <label class="form-label fw-semibold">Variedad</label>
                <input type="text" name="variedad" class="form-control rounded-3 @error('variedad') is-invalid @enderror" value="{{ old('variedad', $producto->variedad) }}">
                @error('variedad')
                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                @enderror
            </div>

            {{-- Botón de envío --}}
            <div class="col-12 text-start">
                <button type="submit" class="btn btn-primary rounded-3 px-4 fw-semibold">Actualizar producto</button>
            </div>
        </div>
    </form>

</div>

<script>
    document.getElementById('imagenProducto').addEventListener('change', function(e){
        let archivo = e.target.files[0];
        if(!archivo) return;

        let preview = document.getElementById('previewNueva');
        if(archivo.type.startsWith('image/')){
            preview.src = URL.createObjectURL(archivo);
            preview.style.display='block';
        } else {
            preview.style.display='none';
        }
    });
</script>

</x-admin-layout>