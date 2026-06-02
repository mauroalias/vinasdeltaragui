<x-admin-layout title="Panel Administrador">

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="fw-bold">
            Productos
        </h1>

        <a href="/admin/productos/crear"
           class="btn btn-success rounded-3 shadow-sm">

            + Nuevo producto

        </a>

    </div>

    @if(session('success_message'))

        <div class="alert alert-success shadow-sm">

            {{ session('success_message') }}

        </div>

    @endif

    <div class="card shadow border-0 rounded-4 overflow-hidden">

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Imagen</th>

                        <th>Producto</th>

                        <th>Categoría</th>

                        <th>Precio</th>

                        <th>Stock</th>

                        <th>Estado</th>

                        <th class="text-center">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($productos as $producto)

                    <tr>

                        <td>
                            {{ $producto->id }}
                        </td>

            <td>

                @if($producto->url_imagen)

                <img
                src="{{ asset('img/' . $producto->url_imagen) }}"
                width="70"
                class="rounded shadow">

                @endif

            </td>

                        <td class="fw-semibold">

                            {{ $producto->nombre }}

                        </td>

                        <td>

                            {{ $producto->categoria->nombre }}

                        </td>

                        <td>

                            ${{ number_format($producto->precio,0,",",".") }}

                        </td>

                        <td>

                            @if($producto->stock > 0)

                                <span class="badge bg-success">

                                    {{ $producto->stock }}

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    SIN STOCK

                                </span>

                            @endif

                        </td>

                        <td>

    @if($producto->activo)

        <span class="badge bg-success">
            Activo
        </span>

    @else

        <span class="badge bg-secondary">
            Inactivo
        </span>

    @endif

</td>

                        <td>

    <div class="d-flex gap-2 justify-content-center">

        <a
            href="/admin/productos/{{ $producto->id }}/editar"
            class="btn btn-success btn-sm rounded-3">

            Modificar

        </a>

        @if($producto->activo)

            <form
                action="/admin/productos/baja"
                method="POST">

                @csrf

                <input
                    type="hidden"
                    name="id"
                    value="{{ $producto->id }}">

                <button
                    class="btn btn-danger btn-sm rounded-3"
                    onclick="return confirm('¿Dar de baja este producto?')">

                    Baja

                </button>

            </form>

        @else

            <form
                action="/admin/productos/reactivar"
                method="POST">

                @csrf

                <input
                    type="hidden"
                    name="id"
                    value="{{ $producto->id }}">

                <button
                    class="btn btn-primary btn-sm rounded-3"
                    onclick="return confirm('¿Reactivar producto?')">

                    Reactivar

                </button>

            </form>

        @endif

    </div>

</td>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center py-4">

                            No hay productos registrados.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-admin-layout>