<x-layout title="Historial Global de Ventas">

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Historial Completo de Ventas</h2>
            <p class="text-muted small mb-0">Listado completo de pedidos confirmados en la tienda</p>
        </div>
    </div>

    {{-- Buscador --}}
    <div class="card border-0 shadow-sm p-3 mb-4 rounded-3">
        <form action="{{ route('admin.ventas.index') }}" method="GET" class="row g-2">
            <div class="col-md-10">
                <input type="text" name="buscar" class="form-control" 
                       placeholder="Buscar por N° de pedido, nombre o email del cliente..." 
                       value="{{ request('buscar') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100">
                    <i class="fas fa-search me-1"></i> Buscar
                </button>
            </div>
        </form>
    </div>

    {{-- Tabla de Ventas --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        @if($ventas->isEmpty())
            <div class="text-center py-5">
                <p class="text-muted mb-0">No se encontraron ventas registradas con esos criterios.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table align-middle mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Pedido #</th>
                            <th>Cliente</th>
                            <th>Fecha y Hora</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">#{{ $venta->id }}</td>
                            <td>
                                <span class="fw-bold d-block text-dark">{{ $venta->usuario->name }}</span>
                                <span class="text-muted small">{{ $venta->usuario->email }}</span>
                            </td>
                            <td>
                                <div>{{ $venta->fecha_venta->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $venta->fecha_venta->format('H:i') }} hs</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary rounded-pill px-2.5 py-1.5">
                                    {{ $venta->detalles->count() }} prod.
                                </span>
                            </td>
                            <td class="fw-bold text-dark">
                                ${{ number_format($venta->total, 0, ',', '.') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.cliente.historial', $venta->user_id) }}" class="btn btn-sm btn-outline-primary rounded-2">
                                        <i class="fas fa-user me-1"></i> Perfil Cliente
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $ventas->appends(['buscar' => request('buscar')])->links() }}
    </div>
</div>

</x-layout>