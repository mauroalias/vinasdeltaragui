<x-layout title="Finalizar Compra">

<div class="container my-5">
    <div class="row g-5">
    <!-- Columna izquierda -->
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
                        <input type="text" class="form-control" name="direccion" id="input_direccion" placeholder="Calle, número, barrio...">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-bold">Piso (Opcional)</label>
                        <input type="text" class="form-control" name="piso" id="input_piso" placeholder="Ej: 4to">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-bold">Departamento (Opcional)</label>
                        <input type="text" class="form-control" name="departamento" id="input_depto" placeholder="Ej: B">
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

        <!-- PAGO -->
        <h5 class="mb-3 fw-bold">3. Método de pago</h5>

        <!-- Opción 1: Tarjeta de Crédito / Débito -->
        <div class="caja-seleccion mb-3" id="contenedor_mp" style="border-color: #0d6efd; background-color: #f0f7ff;">
            <div class="form-check d-flex align-items-center mb-2">
                <input class="form-check-input" type="radio" name="pago" id="pago_mp" value="tarjeta" checked onchange="togglePago()">
                <label class="form-check-label fw-bold ms-2" for="pago_mp">Tarjeta de Crédito o Débito</label>
            </div>
            
            <!-- FORMULARIO DE TARJETA -->
            <div id="info_mp" class="mt-3 ms-4 pe-2">
                <div class="row g-3">
                    <!-- Número de Tarjeta -->
                    <div class="col-12">
                        <label class="form-label text-muted small fw-bold">Número de tarjeta</label>
                        <input type="text" class="form-control input-tarjeta-campo" name="numero_tarjeta" id="num_tarjeta" placeholder="•••• •••• •••• ••••" inputmode="numeric" maxlength="19" required>
                    </div>
                    
                    <!-- Nombre del Titular -->
                    <div class="col-12">
                        <label class="form-label text-muted small fw-bold">Nombre del titular (como figura en la tarjeta)</label>
                        <input type="text" class="form-control input-tarjeta-campo" name="titular_tarjeta" id="titular_tarjeta" value="{{ auth()->user()->name ?? '' }}" required>
                    </div>

                    <!-- Vencimiento -->
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-bold">Vencimiento</label>
                        <input type="text" class="form-control input-tarjeta-campo" name="vencimiento_tarjeta" id="vence_tarjeta" placeholder="MM/AA" maxlength="5" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" title="Ingresá una fecha válida (MM/AA). El mes debe ser de 01 a 12." required>
                    </div>

                    <!-- Código de seguridad (3 dígitos) -->
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-bold">Cód. de seguridad</label>
                        <input type="text" class="form-control input-tarjeta-campo" name="cvv_tarjeta" id="cvv_tarjeta" placeholder="Ej: 123" inputmode="numeric" pattern="[0-9]{3}" maxlength="3" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Opción 2: Transferencia Bancaria -->
        <div class="caja-seleccion mb-4" id="contenedor_transferencia">
            <div class="form-check d-flex align-items-center">
                <input class="form-check-input" type="radio" name="pago" id="pago_transferencia" value="transferencia" onchange="togglePago()">
                <label class="form-check-label fw-bold ms-2" for="pago_transferencia">Transferencia Bancaria directa</label>
            </div>
            
            <!-- Datos de la cuenta -->
            <div id="info_transferencia" class="mt-3 ms-4 p-3 rounded" style="display: none; background-color: #fff; border: 1px solid #dee2e6;">
                <h6 class="fw-bold text-dark mb-2">Datos para realizar la transferencia:</h6>
                <ul class="list-unstyled mb-0 small text-muted">
                    <li><strong>Banco:</strong> Banco de Corrientes</li>
                    <li><strong>Titular:</strong> Viñas del Taragüí S.H.</li>
                    <li><strong>CBU:</strong> 0940000000000000000000</li>
                    <li><strong>Alias:</strong> vinas.taragui</li>
                </ul>
                <small class="d-block mt-2 text-danger fw-bold">Por favor, enviá el comprobante de pago por WhatsApp una vez realizado.</small>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold mt-2">
            CONFIRMAR COMPRA
        </button>
    </form>
</div>

        <!-- Columna derecha -->
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
    // 1. CONTROL DE VISIBILIDAD DE ENVÍO Y PAGO
    function toggleEnvio() {
        const retiroSeleccionado = document.getElementById('retiro').checked;
        const formularioDireccion = document.getElementById('formulario_direccion');
        
        const inputDireccion = document.getElementById('input_direccion');
        const inputProvincia = document.getElementById('input_provincia');
        const inputCp = document.getElementById('input_cp');

        if (retiroSeleccionado) {
            formularioDireccion.style.display = 'none';
            inputDireccion.removeAttribute('required');
            inputProvincia.removeAttribute('required');
            inputCp.removeAttribute('required');
        } else {
            formularioDireccion.style.display = 'block';
            inputDireccion.setAttribute('required', 'required');
            inputProvincia.setAttribute('required', 'required');
            inputCp.setAttribute('required', 'required');
        }
    }

    function togglePago() {
        const mpSeleccionado = document.getElementById('pago_mp').checked;
        const contenedorMp = document.getElementById('contenedor_mp');
        const infoMp = document.getElementById('info_mp');
        const contenedorTransf = document.getElementById('contenedor_transferencia');
        const infoTransf = document.getElementById('info_transferencia');
        const inputsTarjeta = document.querySelectorAll('.input-tarjeta-campo');

        if (mpSeleccionado) {
            contenedorMp.style.borderColor = '#0d6efd';
            contenedorMp.style.backgroundColor = '#f0f7ff';
            infoMp.style.display = 'block';
            inputsTarjeta.forEach(input => input.setAttribute('required', 'required'));
            contenedorTransf.style.borderColor = '#dee2e6';
            contenedorTransf.style.backgroundColor = '#f8f9fa';
            infoTransf.style.display = 'none';
        } else {
            contenedorTransf.style.borderColor = '#0d6efd';
            contenedorTransf.style.backgroundColor = '#f0f7ff';
            infoTransf.style.display = 'block';
            contenedorMp.style.borderColor = '#dee2e6';
            contenedorMp.style.backgroundColor = '#f8f9fa';
            infoMp.style.display = 'none';
            inputsTarjeta.forEach(input => input.removeAttribute('required'));
        }
    }

    // 2. MÁSCARAS Y VALIDACIONES EN TIEMPO REAL
    document.addEventListener("DOMContentLoaded", function() {

        // --- DETECTOR DE BOTÓN ATRÁS (Evita el BFCache del navegador) ---
        window.addEventListener('pageshow', function(event) {
            const navigationType = performance.getEntriesByType("navigation")[0]?.type;
            if (event.persisted || navigationType === "back_forward") {
                window.location.reload();
            }
        });
        
        // --- Validación Teléfono ---
        const inputTelefono = document.querySelector('input[name="telefono"]');
        if (inputTelefono) {
            inputTelefono.setAttribute('pattern', '[0-9\\s\\-]{8,15}');
            inputTelefono.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9\s\-]/g, '');
            });
        }

        // --- Validación Dirección ---
        const inputDireccion = document.getElementById('input_direccion');
        if (inputDireccion) {
            inputDireccion.setAttribute('pattern', '.{5,}');
        }

        // --- Validación Código Postal ---
        const inputCp = document.getElementById('input_cp');
        if (inputCp) {
            inputCp.setAttribute('pattern', '[A-Z0-9]{4,8}');
            inputCp.addEventListener('input', function() {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            });
        }

        // --- Separador de espacios en la Tarjeta ---
        const inputTarjeta = document.getElementById('num_tarjeta');
        if (inputTarjeta) {
            inputTarjeta.setAttribute('maxlength', '19');
            inputTarjeta.addEventListener('input', function() {
                let valor = this.value.replace(/\D/g, ''); 
                let valorFormateado = valor.match(/.{1,4}/g);
                this.value = valorFormateado ? valorFormateado.join(' ') : valor;
            });
        }

        // --- Barra automática en Vencimiento ---
        const inputVence = document.getElementById('vence_tarjeta');
        if (inputVence) {
            inputVence.addEventListener('input', function() {
                let valor = this.value.replace(/\D/g, ''); 
                if (valor.length >= 2) {
                    let mes = valor.substring(0, 2);
                    let anio = valor.substring(2, 4);
                    this.value = mes + '/' + anio;
                } else {
                    this.value = valor;
                }
            });

            inputVence.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value.length === 3) {
                    this.value = this.value.substring(0, 2);
                }
            });
        }

        // --- Bloqueo de letras en Código de Seguridad (CVV) ---
        const inputCvv = document.getElementById('cvv_tarjeta');
        if (inputCvv) {
            inputCvv.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, ''); 
            });
        }

        // --- Validación de Tarjeta Vencida al Enviar el Formulario ---
        const formulario = document.querySelector('form[action="/procesar-compra"]');
        if (formulario && inputVence) {
            formulario.addEventListener('submit', function(e) {
                const pagoMp = document.getElementById('pago_mp');
                if (pagoMp && !pagoMp.checked) return;

                const valor = inputVence.value; 
                if (valor.length === 5) {
                    const partes = valor.split('/');
                    const mesInput = parseInt(partes[0], 10);
                    const anioInput = parseInt('20' + partes[1], 10); 

                    const fechaActual = new Date();
                    const mesActual = fechaActual.getMonth() + 1; 
                    const anioActual = fechaActual.getFullYear();

                    if (anioInput < anioActual || (anioInput === anioActual && mesInput < mesActual)) {
                        e.preventDefault(); 
                        inputVence.setCustomValidity("La tarjeta está vencida. Revisá la fecha.");
                        inputVence.reportValidity();
                    } else {
                        inputVence.setCustomValidity("");
                    }
                }
            });

            inputVence.addEventListener('input', function() {
                this.setCustomValidity("");
            });
        }

    }); 
</script>

</x-layout>