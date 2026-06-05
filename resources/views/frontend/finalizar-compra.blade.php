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
                        <input type="text" class="form-control form-control-lg bg-light" name="nombre" value="{{ auth()->user()->name ?? '' }}" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-bold">Correo electrónico</label>
                        <input type="email" class="form-control form-control-lg bg-light" name="email" value="{{ auth()->user()->email ?? '' }}" readonly required>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted small fw-bold">Teléfono de contacto</label>
                        <input type="text" 
                               class="form-control form-control-lg {{ isset($datosFacturacion->telefono) ? 'bg-light' : '' }}" 
                               name="telefono" 
                               value="{{ $datosFacturacion->telefono ?? '' }}" 
                               {{ isset($datosFacturacion->telefono) ? 'readonly' : '' }} 
                               required>
                               
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                            @if(isset($datosFacturacion->telefono))
                                <i class="fas fa-lock me-1"></i> Para modificar estos datos, ingresá a <a href="/perfil" class="text-dark fw-bold">Mi Perfil</a>.
                            @else
                                Ingresá un teléfono para esta compra. Podés guardarlo permanentemente desde tu Perfil.
                            @endif
                        </small>
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
                        <div class="alert alert-light border rounded-3 mb-0">
                            <strong class="d-block mb-1">Dirección de envío:</strong>

                            @if(isset($datosFacturacion) && $datosFacturacion->direccion)
                                <span class="fs-6">{{ $datosFacturacion->direccion }}</span>
                                <hr class="my-2 text-muted">
                                <small class="text-muted d-block" style="font-size: 0.75rem;">
                                    <i class="fas fa-lock me-1"></i> Para modificar tu dirección de entrega, ingresá a <a href="/perfil" class="text-dark fw-bold">Mi Perfil</a>.
                                </small>
                            @else
                                <span class="text-danger mb-2 d-block">No tenés una dirección guardada.</span>
                                <small class="text-muted d-block mb-2" style="font-size: 0.75rem;">
                                    Es necesario registrar una dirección en tu perfil para los envíos a domicilio.
                                </small>
                                <a href="/perfil" class="btn btn-sm btn-outline-dark">
                                    Ir a mi perfil
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <h5 class="mb-3 fw-bold">3. Método de pago</h5>

                <div class="caja-seleccion mb-3" id="contenedor_mp" style="border-color: #0d6efd; background-color: #f0f7ff;">
                    <div class="form-check d-flex align-items-center mb-2">
                        <input class="form-check-input" type="radio" name="pago" id="pago_mp" value="tarjeta" checked onchange="togglePago()">
                        <label class="form-check-label fw-bold ms-2" for="pago_mp">Tarjeta de Crédito o Débito</label>
                    </div>
                    
                    <div id="info_mp" class="mt-3 ms-4 pe-2">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-muted small fw-bold">Número de tarjeta</label>
                                <input type="text" class="form-control input-tarjeta-campo" name="numero_tarjeta" id="num_tarjeta" placeholder="•••• •••• •••• ••••" inputmode="numeric" maxlength="19" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label text-muted small fw-bold">Nombre del titular (como figura en la tarjeta)</label>
                                <input type="text" class="form-control input-tarjeta-campo" name="titular_tarjeta" id="titular_tarjeta" value="{{ auth()->user()->name ?? '' }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Vencimiento</label>
                                <input type="text" class="form-control input-tarjeta-campo" name="vencimiento_tarjeta" id="vence_tarjeta" placeholder="MM/AA" maxlength="5" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" title="Ingresá una fecha válida (MM/AA). El mes debe ser de 01 a 12." required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Cód. de seguridad</label>
                                <input type="text" class="form-control input-tarjeta-campo" name="cvv_tarjeta" id="cvv_tarjeta" placeholder="Ej: 123" inputmode="numeric" pattern="[0-9]{3}" maxlength="3" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="caja-seleccion mb-4" id="contenedor_transferencia">
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="pago" id="pago_transferencia" value="transferencia" onchange="togglePago()">
                        <label class="form-check-label fw-bold ms-2" for="pago_transferencia">Transferencia Bancaria directa</label>
                    </div>
                    
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

                <button type="submit" id="btn-comprar" class="btn btn-primary btn-lg w-100 py-3 fw-bold mt-2">
                    CONFIRMAR COMPRA
                </button>
            </form>
        </div>

        <!-- Columna derecha -->
        <div class="col-lg-5">
            <!-- Le sacamos el h-100, d-flex y flex-column para que no se estire hacia abajo -->
            <div class="p-4 rounded-4 text-white shadow-lg" style="background-color: #1f2227;">
                
                <div class="text-center mb-4">
                    <img src="{{ asset('img/logo1.png') }}" alt="Viñas del Taragüí" style="max-height: 70px;">
                </div>

                <h5 class="text-center text-uppercase fw-light mb-0" style="letter-spacing: 2px;">Resumen del pedido</h5>
                <hr style="border-color: rgba(255, 255, 255, 0.15); margin: 20px 0;">

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show p-2 small text-center mb-3" role="alert" style="background-color: rgba(220, 53, 69, 0.1); border-color: rgba(220, 53, 69, 0.5); color: #ff6b6b;">
                        <strong>¡Aviso!</strong> {{ session('error') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.5rem;"></button>
                    </div>
                @endif

                <!-- Le sacamos flex-grow-1 -->
                <div class="pe-2 mb-4">
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

                <!-- Le sacamos margin-top: auto al HR -->
                <hr style="border-color: rgba(255, 255, 255, 0.15);">

                <div class="text-center mb-4">
                    <a href="/carrito/vaciar" class="text-danger text-decoration-none" style="font-size: 0.9rem;">
                        <i class="fas fa-trash"></i> Vaciar el carrito
                    </a>
                </div>

                <div class="d-flex justify-content-between text-white-50 mb-2">
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
        const envioSeleccionado = document.getElementById('envio').checked;
        const formularioDireccion = document.getElementById('formulario_direccion');
        const btnComprar = document.getElementById('btn-comprar');
        
        const tieneDireccion = {{ (isset($datosFacturacion) && $datosFacturacion->direccion) ? 'true' : 'false' }};

        formularioDireccion.style.display = retiroSeleccionado ? 'none' : 'block';

        if (envioSeleccionado && !tieneDireccion) {
            btnComprar.disabled = true;
            btnComprar.classList.add('opacity-50');
        } else {
            btnComprar.disabled = false;
            btnComprar.classList.remove('opacity-50');
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

        window.addEventListener('pageshow', function(event) {
            const navigationType = performance.getEntriesByType("navigation")[0]?.type;
            if (event.persisted || navigationType === "back_forward") {
                window.location.reload();
            }
        });
        
        const inputTelefono = document.querySelector('input[name="telefono"]');
        if (inputTelefono) {
            inputTelefono.setAttribute('pattern', '[0-9\\s\\-]{8,15}');
            inputTelefono.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9\s\-]/g, '');
            });
        }

        const inputTarjeta = document.getElementById('num_tarjeta');
        if (inputTarjeta) {
            inputTarjeta.setAttribute('maxlength', '19');
            inputTarjeta.addEventListener('input', function() {
                let valor = this.value.replace(/\D/g, ''); 
                let valorFormateado = valor.match(/.{1,4}/g);
                this.value = valorFormateado ? valorFormateado.join(' ') : valor;
            });
        }

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

        const inputCvv = document.getElementById('cvv_tarjeta');
        if (inputCvv) {
            inputCvv.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, ''); 
            });
        }

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