<x-layout title="Finalizar Compra">

<div class="container my-5">
    <div class="row g-5">
        
        <div class="col-lg-7">
    <h3 class="mb-4 fw-bold">Detalles de facturación</h3>
    
    <form action="/procesar-compra" method="POST">
        @csrf
        
        <h5 class="mb-3 fw-bold">1. Datos de contacto</h5>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label text-muted small fw-bold">Nombre y apellido</label>
                <input type="text" class="form-control form-control-lg" name="nombre" value="{{ auth()->user()->name ?? '' }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label text-muted small fw-bold">Correo electrónico</label>
                <input type="email" class="form-control form-control-lg" name="email" value="{{ auth()->user()->email ?? '' }}" required>
            </div>
            <div class="col-12">
                <label class="form-label text-muted small fw-bold">Teléfono de contacto</label>
                <input type="text" class="form-control form-control-lg" name="telefono" required>
            </div>
        </div>

        <h5 class="mb-3 fw-bold">2. Método de entrega</h5>

        <div class="caja-seleccion mb-3">
            <div class="form-check d-flex justify-content-between align-items-center w-100">
                <div>
                    <input class="form-check-input" type="radio" name="tipo_entrega" id="retiro" value="retiro" checked onchange="toggleEnvio()">
                    <label class="form-check-label fw-bold ms-2" for="retiro">Retiro por sucursal</label>
                    <small class="d-block text-muted ms-4">San Juan 1567, Corrientes</small>
                </div>
                <span class="text-success fw-bold">Gratis</span>
            </div>
        </div>

        <div class="caja-seleccion mb-4">
            <div class="form-check d-flex justify-content-between align-items-center w-100 mb-2">
                <div>
                    <input class="form-check-input" type="radio" name="tipo_entrega" id="envio" value="envio" onchange="toggleEnvio()">
                    <label class="form-check-label fw-bold ms-2" for="envio">Envío a domicilio</label>
                </div>
                <span class="fw-bold">A cotizar</span>
            </div>

            <div id="formulario_direccion" class="mt-3 ms-4 pe-3" style="display: none;">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-muted small fw-bold">Dirección completa</label>
                        <input type="text" class="form-control" name="direccion" id="input_direccion" placeholder="Calle, número, depto, barrio...">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label text-muted small fw-bold">Provincia</label>
                        <select class="form-select" name="provincia" id="input_provincia">
                            <option value="" selected disabled>Seleccioná tu provincia...</option>
                            <option value="Buenos Aires">Buenos Aires</option>
                            <option value="Catamarca">Catamarca</option>
                            <option value="Chaco">Chaco</option>
                            <option value="Chubut">Chubut</option>
                            <option value="Córdoba">Córdoba</option>
                            <option value="Corrientes">Corrientes</option>
                            <option value="Entre Ríos">Entre Ríos</option>
                            <option value="Formosa">Formosa</option>
                            <option value="Jujuy">Jujuy</option>
                            <option value="La Pampa">La Pampa</option>
                            <option value="La Rioja">La Rioja</option>
                            <option value="Mendoza">Mendoza</option>
                            <option value="Misiones">Misiones</option>
                            <option value="Neuquén">Neuquén</option>
                            <option value="Río Negro">Río Negro</option>
                            <option value="Salta">Salta</option>
                            <option value="San Juan">San Juan</option>
                            <option value="San Luis">San Luis</option>
                            <option value="Santa Cruz">Santa Cruz</option>
                            <option value="Santa Fe">Santa Fe</option>
                            <option value="Santiago del Estero">Santiago del Estero</option>
                            <option value="Tierra del Fuego">Tierra del Fuego</option>
                            <option value="Tucumán">Tucumán</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small fw-bold">Cód. Postal</label>
                        <input type="text" class="form-control" name="codigo_postal" id="input_cp" placeholder="Ej: 3500">
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mb-3 fw-bold">3. Método de pago</h5>
        <div class="caja-seleccion mb-4" style="border-color: #0d6efd; background-color: #f0f7ff;">
            <div class="form-check d-flex align-items-center">
                <input class="form-check-input" type="radio" name="pago" id="mercadopago" value="mercadopago" checked>
                <label class="form-check-label fw-bold ms-2" for="mercadopago">MercadoPago</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold mt-2">
            CONFIRMAR COMPRA
        </button>
    </form>
</div>

        <div class="col-lg-5">
    <div class="p-4 rounded-4 text-white shadow-lg d-flex flex-column" style="background-color: #1f2227; min-height: 100%;">
        
        <div class="text-center mb-4">
            <img src="{{ asset('img/logo1.png') }}" alt="Viñas del Taragüí" style="max-height: 70px;">
        </div>

        <h5 class="text-center text-uppercase fw-light mb-0" style="letter-spacing: 2px;">Resumen del pedido</h5>
        <hr style="border-color: rgba(255, 255, 255, 0.15); margin: 20px 0;">

        <div class="flex-grow-1 overflow-auto pe-2 mb-4" style="max-height: 380px;">
            @if(count($carrito) > 0)
                @foreach($carrito as $clave => $item)
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3" style="border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                        
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/' . $item['imagen']) }}" class="rounded shadow-sm me-3" style="width: 65px; height: 65px; object-fit: contain; background-color: #fff; padding: 4px;">
                            
                            <div>
                                <h6 class="mb-1 small fw-bold">{{ $item['nombre'] }}</h6>
                                
                                <div class="d-flex align-items-center mt-2">
                                    <a href="/carrito/restar/{{ $clave }}" class="btn btn-sm btn-outline-light d-flex align-items-center justify-content-center" style="width: 25px; height: 25px; padding: 0;">-</a>
                                    
                                    <span class="mx-2 small fw-bold">{{ $item['cantidad'] }}</span>
                                    
                                    <a href="/carrito/sumar/{{ $clave }}" class="btn btn-sm btn-outline-light d-flex align-items-center justify-content-center" style="width: 25px; height: 25px; padding: 0;">+</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end ms-2">
                            <div class="fw-bold mb-2">${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</div>
                            <a href="/carrito/eliminar/{{ $clave }}" class="text-danger small text-decoration-none border-bottom border-danger" style="font-size: 0.75rem;">Eliminar</a>
                        </div>

                    </div>
                @endforeach
            @else
                <div class="text-center text-white-50 my-5">
                    <p>Tu carrito está vacío.</p>
                    <a href="/catalogo" class="btn btn-outline-light btn-sm mt-2">Volver al catálogo</a>
                </div>
            @endif
        </div>

        <hr style="border-color: rgba(255, 255, 255, 0.15); margin-top: auto;">

        <div class="d-flex justify-content-between text-white-50 mb-2 mt-2">
            <span>Subtotal</span>
            <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <div class="d-flex justify-content-between text-white-50 mb-3">
            <span>Envío</span>
            <span class="fst-italic small">Aún sin calcular</span>
        </div>
        
        <div class="d-flex justify-content-between text-white fw-bold fs-4 pt-3 mt-2" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
            <span>Total actual:</span>
            <span class="text-success">${{ number_format($total, 0, ',', '.') }}</span>
        </div>

    </div>
</div>

<script>
    function toggleEnvio() {
        // Seleccionamos los elementos del DOM
        const retiroSeleccionado = document.getElementById('retiro').checked;
        const formularioDireccion = document.getElementById('formulario_direccion');
        
        // Seleccionamos los inputs que están dentro del panel de envío
        const inputDireccion = document.getElementById('input_direccion');
        const inputProvincia = document.getElementById('input_provincia');
        const inputCp = document.getElementById('input_cp');

        if (retiroSeleccionado) {
            // Ocultamos la caja
            formularioDireccion.style.display = 'none';
            // Les quitamos el "required" para que deje procesar la compra
            inputDireccion.removeAttribute('required');
            inputProvincia.removeAttribute('required');
            inputCp.removeAttribute('required');
        } else {
            // Mostramos la caja
            formularioDireccion.style.display = 'block';
            // Los hacemos obligatorios
            inputDireccion.setAttribute('required', 'required');
            inputProvincia.setAttribute('required', 'required');
            inputCp.setAttribute('required', 'required');
        }
    }
</script>

</x-layout>