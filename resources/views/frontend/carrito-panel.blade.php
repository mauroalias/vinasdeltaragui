<div class="offcanvas offcanvas-end carrito-panel" tabindex="-1" id="panelCarrito">

    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">TU PEDIDO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

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