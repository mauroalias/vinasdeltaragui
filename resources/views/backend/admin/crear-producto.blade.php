<x-admin-layout title="Panel Administrador">

<div class="container my-5">

<div class="card shadow border-0">

<div class="card-body p-4">

<h2 class="mb-4">

Agregar producto

</h2>

<form action="/admin/productos" method="POST">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label>Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
required>

</div>

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

<div class="col-md-6 mb-3">

<label>Precio</label>

<input
type="number"
name="precio"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Stock</label>

<input
type="number"
name="stock"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Descripción</label>

<textarea
name="descripcion"
class="form-control"></textarea>

</div>

<div class="mb-3">

<label>Ruta imagen</label>

<input
type="text"
name="url_imagen"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Origen</label>

<input
type="text"
name="origen"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Bodega</label>

<input
type="text"
name="bodega"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Graduación</label>

<input
type="text"
name="graduacion"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Volumen</label>

<input
type="text"
name="volumen"
class="form-control">

</div>

<div class="mb-3">

<label>Variedad</label>

<input
type="text"
name="variedad"
class="form-control">

</div>

<div>

<button
class="btn btn-success">

Guardar producto

</button>

</div>

</div>

</form>

</div>

</div>

</div>

</x-admin-layout>