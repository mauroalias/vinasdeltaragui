<x-admin-layout title="Editar Producto">

<div class="container my-5">

    <div class="container py-5">

    <div class="mb-5 text-center">

        <h1 class="fw-bold">
            Modificación de Productos
        </h1>

        <p class="text-muted mb-0">
            Edita los datos de los productos activos de la tienda
        </p>

    </div>

            <form
                action="/admin/productos/{{ $producto->id }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Nombre</label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            value="{{ $producto->nombre }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Categoría</label>

                        <select
                            name="categoria_id"
                            class="form-select">

                            @foreach($categorias as $categoria)

                                <option
                                    value="{{ $categoria->id }}"
                                    {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>

                                    {{ $categoria->nombre }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Precio</label>

                        <input
                            type="number"
                            name="precio"
                            class="form-control"
                            value="{{ $producto->precio }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Stock</label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            value="{{ $producto->stock }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Descripción</label>

                        <textarea
                            name="descripcion"
                            class="form-control">{{ $producto->descripcion }}</textarea>

                    </div>

                    

@if($producto->url_imagen)

<div class="mb-4">

    <label class="form-label fw-semibold">
        Imagen actual
    </label>

    <div>

        <img
            src="{{ asset('img/' . $producto->url_imagen) }}"
            class="img-fluid rounded shadow"
            style="
                max-height:250px;
                object-fit:contain;
            ">

    </div>

</div>

@endif


<div class="mb-3">

    <label class="form-label fw-semibold">
        Seleccionar nueva imagen
    </label>

    <input
        class="form-control"
        type="file"
        name="url_imagen"
        id="imagenProducto">

</div>

@error('url_imagen')

<div class="text-danger mt-2">

    {{ $message }}

</div>

@enderror


<div class="mb-4">

    <img
        id="previewNueva"
        class="img-fluid rounded shadow"
        style="
            max-height:250px;
            object-fit:contain;
            display:none;
        ">

</div>


<script>

document
.getElementById('imagenProducto')
.addEventListener('change', function(e){

    let archivo = e.target.files[0];

    if(!archivo){
        return;
    }

    let preview =
        document.getElementById('previewNueva');

    if(archivo.type.startsWith('image/')){

        preview.src =
            URL.createObjectURL(archivo);

        preview.style.display='block';

    } else {

        preview.style.display='none';

    }

});

</script>
 

                        <label>Origen</label>

                        <input
                            type="text"
                            name="origen"
                            class="form-control"
                            value="{{ $producto->origen }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Bodega</label>

                        <input
                            type="text"
                            name="bodega"
                            class="form-control"
                            value="{{ $producto->bodega }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Graduación</label>

                        <input
                            type="text"
                            name="graduacion"
                            class="form-control"
                            value="{{ $producto->graduacion }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Volumen</label>

                        <input
                            type="text"
                            name="volumen"
                            class="form-control"
                            value="{{ $producto->volumen }}">

                    </div>

                    <div class="mb-3">

                        <label>Variedad</label>

                        <input
                            type="text"
                            name="variedad"
                            class="form-control"
                            value="{{ $producto->variedad }}">

                    </div>

                    <div>

                        <button class="btn btn-primary">

                            Actualizar producto

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

</x-admin-layout>