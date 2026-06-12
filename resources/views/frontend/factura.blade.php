@php
    $nombreLayout = (auth()->check() && auth()->user()->rol === 'admin') ? 'admin-layout' : 'layout';
@endphp

<x-dynamic-component :component="$nombreLayout" title="Comprobante de Compra">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="mb-3 d-print-none">
                <a href="/catalogo" class="text-decoration-none text-muted small">
                    <i class="fas fa-arrow-left"></i> Volver a la tienda
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden" id="area-factura">
                
                <div class="p-4 text-center text-white" style="background-color: #1f2227;">
                    <img src="{{ asset('img/logo1.png') }}" alt="Viñas del Taragüí" style="max-height: 80px;" class="mb-3">
                    <h4 class="text-uppercase fw-light mb-0" style="letter-spacing: 2px;">Comprobante de Pedido</h4>
                    <p class="text-white-50 mb-0 mt-2 small">¡Gracias por tu compra, {{ $pedido->usuario->name }}!</p>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    
                    <div class="row mb-4 border-bottom pb-3">
                        <div class="col-6">
                            <p class="text-muted small mb-1">Número de Orden</p>
                            <h6 class="fw-bold text-primary">#VDT-{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                        <div class="col-6 text-end">
                            <p class="text-muted small mb-1">Fecha de operación</p>
                            <h6 class="fw-bold">{{ $pedido->fecha_venta ? $pedido->fecha_venta->format('d/m/Y H:i') : now()->format('d/m/Y') }}</h6>
                        </div>
                    </div>

                    <h6 class="text-uppercase fw-bold text-muted small mb-3">Detalle de artículos</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-borderless table-sm mb-0">
                            <thead class="border-bottom">
                                <tr class="text-muted small">
                                    <th>Cant.</th>
                                    <th>Producto</th>
                                    <th class="text-end">P. Unit</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedido->detalles as $detalle)
                                <tr class="border-bottom-dashed">
                                    <td class="fw-bold text-center">{{ $detalle->cantidad }}</td>
                                    <td>{{ $detalle->nombre_producto }}</td>
                                    <td class="text-end text-muted">${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold">${{ number_format($detalle->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="border-top pt-3">
                        <div class="d-flex justify-content-between mb-3 small text-muted">
                            <span>Estado de pago</span>
                            <span class="badge bg-success text-uppercase">{{ $pedido->estado }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded">
                            <span class="fw-bold text-dark text-uppercase" style="letter-spacing: 1px;">Total Abonado</span>
                            <span class="fw-bold text-success fs-4">${{ number_format($pedido->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                </div>

                <div class="card-footer bg-white text-center border-0 pb-4 pt-0 d-print-none">
                    <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                        <i class="fas fa-print me-1"></i> Imprimir / Guardar PDF
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .border-bottom-dashed { border-bottom: 1px dashed #dee2e6; }
    /* Ocultar navegación y botones al imprimir */
    @media print {
        header, footer, nav, .d-print-none { display: none !important; }
        body { background-color: white !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
    }
</style>

</x-dynamic-component>