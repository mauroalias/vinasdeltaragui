<x-layout title="Carrito">

<div class="container my-5 d-flex justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">

                <h3 class="text-center mb-4">Finalizar compra</h3>
                
                <button class="btn btn-dark mb-4 w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#panelCarrito" aria-controls="panelCarrito">
                  Ver Mi Pedido
                </button>

                <form action="/procesar-compra" method="POST">
                    @csrf <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            Confirmar Compra
                        </button>
                    </div>
                </form>
                </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="panelCarrito" aria-labelledby="tituloCarrito">
  
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="tituloCarrito">TU PEDIDO</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
  </div>
  
  <div class="offcanvas-body">
    
    @if(session('carrito') && count(session('carrito')) > 0)
        
        @php $subtotal = 0; @endphp

        @foreach(session('carrito') as $item)
            @php 
                $totalProducto = $item['precio'] * $item['cantidad'];
                $subtotal += $totalProducto; 
            @endphp

            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
              <div>
                <h6 class="mb-0">{{ $item['nombre'] }}</h6>
                <div class="mt-2 text-muted">Cant: <span class="badge bg-secondary">{{ $item['cantidad'] }}</span></div>
              </div>
              <div class="text-end">
                <span>${{ number_format($totalProducto, 2, ',', '.') }}</span><br>
                <a href="#" class="text-danger small text-decoration-none">Eliminar</a>
              </div>
            </div>
        @endforeach
        
        <div class="d-flex justify-content-between fw-bold mb-4 mt-3">
          <span>Subtotal:</span>
          <span>${{ number_format($subtotal, 2, ',', '.') }}</span>
        </div>

    @else
        <div class="alert alert-info text-center">
            Aún no agregaste productos a tu pedido.
        </div>
    @endif

    <div class="p-3 bg-light rounded mb-3 mt-auto">
      <h6>Calculá el envío</h6>
      <label class="form-label small">Ingresá tu código postal</label>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Ej: 3500">
        <button class="btn btn-secondary" type="button">Calcular</button>
      </div>
    </div>
    
  </div>
</div>

</x-layout>