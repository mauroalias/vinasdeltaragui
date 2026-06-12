<x-admin-layout title="Historial del Cliente">

<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

<div class="container my-5" style="max-width: 1100px;">
    
    {{-- BOTÓN VOLVER --}}
    <div class="mb-4">
        <a href="/admin" class="btn btn-sm btn-outline-secondary rounded-3">
            <i class="fas fa-arrow-left me-2"></i> Volver al panel
        </a>
    </div>

    {{-- TARJETA RESUMEN DEL CLIENTE --}}
    <div class="card perfil-card p-4 mb-4">
        <div class="row align-items-center">
            <div class="col-md-4 border-end">
                <p class="mb-0 fw-bold fs-5">{{ $cliente->name }}</p>
                <p class="text-muted mb-0">{{ $cliente->email }}</p>
            </div>
            <div class="col-md-4 border-end px-4">
                <p class="info-label mb-1">Contacto y entrega</p>
                <p class="mb-0" style="font-size: 0.85rem;">
                    <i class="fas fa-phone text-muted me-1"></i> {{ $cliente->datosFacturacion->telefono ?? 'No especificado' }}
                </p>
                <p class="mb-0" style="font-size: 0.85rem;">
                    <i class="fas fa-map-marker-alt text-muted me-1"></i> {{ $cliente->datosFacturacion->direccion ?? 'No especificada' }}
                </p>
            </div>
            <div class="col-md-4 px-4">
                <p class="info-label mb-1">Resumen de compras</p>
                <p class="mb-0" style="font-size: 0.85rem;"><strong>{{ $cliente->ventas->count() }}</strong> pedidos realizados</p>
                <p class="text-success mb-0 fw-bold fs-5">
                    ${{ number_format($cliente->ventas->sum('total'), 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    {{-- TABLA DE HISTORIAL --}}
    <div class="card perfil-card p-4">
        <p class="seccion-titulo">Historial de pedidos de {{ strtoupper($cliente->name) }}</p>

        @if($cliente->ventas->count() > 0)
            <div class="table-responsive">
                <table class="table historial-table mb-0">
                    <thead>
                        <tr>
                            <th>Pedido #</th>
                            <th>Fecha</th>
                            <th>Metodo de pago</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cliente->ventas as $venta)
                            <tr>
                                <td class="text-muted">{{ $venta->id }}</td>
                                <td>
                                    {{ $venta->fecha_venta->format('d/m/Y - H:i') }}
                                </td>
                                <td>
                                    <span class="badge bg-success text-uppercase" style="letter-spacing: 0.5px;">
                                        {{ $venta->metodo_pago }}
                                     </span>
                                </td>
                                <td class="fw-bold">
                                    ${{ number_format($venta->total, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge bg-secondary rounded-pill px-3 py-2" style="font-size:0.7rem;">
                                        {{ ucfirst($venta->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="/comprobante/{{ $venta->id }}" target="_blank" class="btn btn-sm btn-outline-dark rounded-2">
                                        <i class="fas fa-file-invoice me-1"></i> Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted mb-0">Este cliente aún no ha realizado compras.</p>
            </div>
        @endif
    </div>

</div>

</x-admin-layout>