<x-admin-layout>

<div class="container py-5">

    <h2 class="mb-4">
        Baja de productos
    </h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card bg-dark text-white p-4 rounded-4 mb-4">

        <form action="{{ route('admin.productos.darBaja') }}"
              method="POST">

            @csrf
            @method('PUT')

            <label class="mb-2">
                ID del producto a dar de baja
            </label>

            <input
                type="number"
                name="id"
                class="form-control mb-3"
                placeholder="Ej: 5"
                required
            >

            <button class="btn btn-danger">
                Dar de baja
            </button>

        </form>

    </div>

    <div class="card p-4">

        <h4 class="mb-3">
            Productos disponibles
        </h4>

        <table class="table table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>

            <tbody>

                @foreach($productos as $producto)

                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ $producto->precio }}</td>
                    <td>{{ $producto->stock }}</td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-admin-layout>