<div class="offcanvas offcanvas-end carrito-panel" tabindex="-1" id="panelCarrito">

    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">TU PEDIDO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

        {{-- ALERTA DE ERROR (EJ: FALTA DE STOCK) --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show py-2 shadow-sm" role="alert">
                <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close pb-1" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if(session('carrito') && count(session('carrito')) > 0)

            @php $subtotal = 0; @endphp

            @foreach(session('carrito') as $clave => $item)
                @php
                    $totalProducto = $item['precio'] * $item['cantidad'];
                    $subtotal += $totalProducto;
                @endphp

                <div class="carrito-item d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">

                    <div class="d-flex align-items-center">
                        <img src="{{ asset('img/' . $item['imagen']) }}" class="carrito-img me-3">

                        <div>
                            <h6 class="mb-1">{{ $item['nombre'] }}</h6>
                            <small>Cantidad: {{ $item['cantidad'] }}</small>
                            <div class="d-flex align-items-center justify-content-between mt-2">
    
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ url('/carrito/restar/' . $clave) }}" class="btn btn-outline-secondary">
                                    -
                                </a>
                                
                                <span class="btn btn-outline-secondary disabled text-dark">
                                    {{ $item['cantidad'] }}
                                </span>
                                
                                <a href="{{ url('/carrito/sumar/' . $clave) }}" class="btn btn-outline-secondary">
                                    +
                                </a>
                            </div>
                        </div>
                            <p class="mb-0 fw-bold">${{ number_format($totalProducto, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <a href="/carrito/eliminar/{{ $clave }}" class="btn btn-sm btn-outline-danger">×</a>
                </div>
            @endforeach

            <div class="d-flex justify-content-between fw-bold fs-5 mt-4">
                <span>Subtotal:</span>
                <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            {{-- ESTE ES EL BOTÓN ROJO PARA VACIAR EL CARRITO LATERAL --}}
            <a href="/carrito/vaciar" class="btn btn-danger w-100 mt-2" onclick="return confirm('¿Seguro que querés vaciar todo el carrito?')">
                VACIAR CARRITO
            </a>

            <a href="/finalizar-compra" class="btn btn-dark w-100 mt-4">
                FINALIZAR COMPRA
            </a>

        @else
            <div class="alert alert-info text-center">
                Aún no agregaste productos a tu pedido.
            </div>
        @endif

    </div>
</div>

    </div>
    </div>

        {{-- SCRIPT GLOBAL PARA MANTENER EL CARRITO ABIERTO --}}
        @if(session('carrito_abierto'))
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            let panelElement = document.getElementById('panelCarrito');
            if(panelElement) {
                let carrito = new bootstrap.Offcanvas(panelElement);
                carrito.show();
            }
        });
        </script>

    @endif