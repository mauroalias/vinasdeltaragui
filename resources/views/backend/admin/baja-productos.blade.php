<x-admin-layout title="Baja de Productos">

<div class="container py-5">

    <div class="mb-5 text-center">
        <h1 class="fw-bold">
            Baja de productos
        </h1>
        <p class="text-muted mb-0">
            Gestioná los productos activos de la tienda
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORMULARIO --}}
    <div class="card shadow border-0 rounded-4 mb-5">
        <div class="card-header bg-dark text-white rounded-top-4 py-3">
            <h5 class="mb-0">
                Dar de baja un producto
            </h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('admin.productos.darBaja') }}" method="POST">
                @csrf
                
                <label class="form-label fw-semibold mb-2">
                    ID del producto
                </label>

                <div class="d-flex gap-3 align-items-start">
                    <div class="flex-grow-1">
                        <input
                            type="number"
                            name="id"
                            class="form-control rounded-3 @error('id') is-invalid @enderror"
                            placeholder="Ej: 5"
                            value="{{ old('id') }}"
                            required>
                        
                        @error('id')
                            <div class="invalid-feedback d-block mt-1 fw-semibold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button
                        class="btn btn-danger rounded-3 px-4"
                        onclick="return confirm('¿Seguro que querés dar de baja este producto?')">
                        Dar de baja
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLA --}}
    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0">
                Productos disponibles
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                    <tr>
                        <td>
                            {{ $producto->id }}
                        </td>
                        <td class="fw-semibold">
                            {{ $producto->nombre }}
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
                                    Sin stock
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($producto->activo)
                                <span class="badge bg-primary">
                                    Activo
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Inactivo
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
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