<x-admin-layout title="Panel Administrador">

<div class="container my-5">
    <div class="container py-5">
        <div class="mb-5 text-center">
            <h1 class="fw-bold">Registro de Productos</h1>
            <p class="text-muted mb-0">Agrega productos a la tienda</p>
        </div>

        <form action="/admin/productos" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="row">

                {{-- Nombre --}}
                <div class="col-md-6 mb-3">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Categoría --}}
                <div class="col-md-6 mb-3">
                    <label>Categoría</label>
                    <select name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror">
                        <option value="" disabled {{ old('categoria_id') ? '' : 'selected' }}>Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Precio --}}
                <div class="col-md-6 mb-3">
                    <label>Precio</label>
                    <input type="number" name="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio') }}">
                    @error('precio')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Stock --}}
                <div class="col-md-6 mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                    @error('stock')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div class="mb-3">
                    <label class="form-label">Imagen del producto</label>
                    <input class="form-control @error('url_imagen') is-invalid @enderror" type="file" name="url_imagen" id="imagenProducto" accept="image/*">
                    @error('url_imagen')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Vista previa --}}
                <div class="text-center mb-4">
                    <img id="preview" class="img-fluid rounded shadow" style="max-height:250px; display:none; object-fit:contain;">
                </div>

                {{-- Origen --}}
                <div class="col-md-6 mb-3">
                    <label>Origen</label>
                    <input type="text" name="origen" class="form-control @error('origen') is-invalid @enderror" value="{{ old('origen') }}">
                    @error('origen')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Bodega --}}
                <div class="col-md-6 mb-3">
                    <label>Bodega</label>
                    <input type="text" name="bodega" class="form-control @error('bodega') is-invalid @enderror" value="{{ old('bodega') }}">
                    @error('bodega')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Graduación --}}
                <div class="col-md-6 mb-3">
                    <label>Graduación</label>
                    <input type="text" name="graduacion" class="form-control @error('graduacion') is-invalid @enderror" value="{{ old('graduacion') }}">
                    @error('graduacion')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Volumen --}}
                <div class="col-md-6 mb-3">
                    <label>Volumen</label>
                    <input type="text" name="volumen" class="form-control @error('volumen') is-invalid @enderror" value="{{ old('volumen') }}">
                    @error('volumen')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Variedad --}}
                <div class="mb-3">
                    <label>Variedad</label>
                    <input type="text" name="variedad" class="form-control @error('variedad') is-invalid @enderror" value="{{ old('variedad') }}">
                    @error('variedad')
                        <div class="text-danger mt-1" style="color: red; font-size: 0.85em;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Botón --}}
                <div>
                    <button class="btn btn-success">Guardar producto</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('imagenProducto').addEventListener('change', function(e){
    let preview = document.getElementById('preview');
    let archivo = e.target.files[0];
    if(archivo){
        preview.src = URL.createObjectURL(archivo);
        preview.style.display = "block";
    }
});
</script>

</x-admin-layout>