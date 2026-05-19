<x-admin-layout title="Panel Administrador">

<div class="container my-5">

    <div class="d-flex justify-content-between mb-4">

        <h1>
            Productos
        </h1>

        <a href="/admin/productos/crear"
           class="btn btn-success">

            + Nuevo producto
        </a>

    </div>

    @if(session('success_message'))

        <div class="alert alert-success">

            {{ session('success_message') }}

        </div>

    @endif

    <div class="card shadow border-0">

        <table class="table">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>

                </tr>

            </thead>

            <tbody>

                @foreach($productos as $producto)

                <tr>

                    <td>{{ $producto->id }}</td>

                    <td>{{ $producto->nombre }}</td>

                    <td>{{ $producto->categoria->nombre }}</td>

                    <td>
                        ${{ number_format($producto->precio,0,",",".") }}
                    </td>

                    <td>{{ $producto->stock }}</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-admin-layout>