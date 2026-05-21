<x-admin-layout title="Panel Administrador">

<div class="container my-5">

    <div class="card shadow border-0">

        <div class="card-body p-4">

            <h2 class="mb-4">
                Agregar producto
            </h2>

            <form action="/admin/productos" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- Nombre --}}
                    <div class="col-md-6 mb-3">

                        <label>Nombre</label>

                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            required>

                    </div>

                    {{-- Categoría --}}
                    <div class="col-md-6 mb-3">

                        <label>Categoría</label>

                        <select
                            name="categoria_id"
                            class="form-select">

                            @foreach($categorias as $categoria)

                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->nombre }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Precio --}}
                    <div class="col-md-6 mb-3">

                        <label>Precio</label>

                        <input
                            type="number"
                            name="precio"
                            class="form-control"
                            required>

                    </div>

                    {{-- Stock --}}
                    <div class="col-md-6 mb-3">

                        <label>Stock</label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            required>

                    </div>

                    {{-- Descripción --}}
                    <div class="mb-3">

                        <label>Descripción</label>

                        <textarea
                            name="descripcion"
                            class="form-control"
                            rows="4"></textarea>

                    </div>

                    {{-- Imagen --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Imagen del producto
                        </label>

                        <input
                            class="form-control"
                            type="file"
                            name="url_imagen"
                            id="imagenProducto"
                            accept="image/*">

                    </div>

                    {{-- Vista previa --}}
                    <div class="text-center mb-4">

                        <img
                            id="preview"
                            class="img-fluid rounded shadow"
                            style="
                                max-height:250px;
                                display:none;
                                object-fit:contain;
                            ">

                    </div>

                    {{-- Origen --}}
                    <div class="col-md-6 mb-3">

                        <label>Origen</label>

                        <input
                            type="text"
                            name="origen"
                            class="form-control">

                    </div>

                    {{-- Bodega --}}
                    <div class="col-md-6 mb-3">

                        <label>Bodega</label>

                        <input
                            type="text"
                            name="bodega"
                            class="form-control">

                    </div>

                    {{-- Graduación --}}
                    <div class="col-md-6 mb-3">

                        <label>Graduación</label>

                        <input
                            type="text"
                            name="graduacion"
                            class="form-control">

                    </div>

                    {{-- Volumen --}}
                    <div class="col-md-6 mb-3">

                        <label>Volumen</label>

                        <input
                            type="text"
                            name="volumen"
                            class="form-control">

                    </div>

                    {{-- Variedad --}}
                    <div class="mb-3">

                        <label>Variedad</label>

                        <input
                            type="text"
                            name="variedad"
                            class="form-control">

                    </div>

                    {{-- Botón --}}
                    <div>

                        <button class="btn btn-success">

                            Guardar producto

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

document
.getElementById('imagenProducto')
.addEventListener('change', function(e){

    let preview = document.getElementById('preview');

    let archivo = e.target.files[0];

    if(archivo){

        preview.src = URL.createObjectURL(archivo);

        preview.style.display = "block";
    }

});

</script>

</x-admin-layout>