<x-layout title="Comercialización">

<div class="container my-5 d-flex justify-content-center">

    <div class="col-md-8">

        <h2 class="text-center mb-4">Comercialización</h2>

        <div class="accordion shadow-sm" id="accordionComercializacion">

            <!-- Formas de pago -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#pago"
                        aria-expanded="true"
                        aria-controls="pago">
                        Formas de pago
                    </button>
                </h2>
                <div id="pago" class="accordion-collapse collapse show"
                    data-bs-parent="#accordionComercializacion">
                    <div class="accordion-body">
                        Aceptamos billeteras virtuales (Mercado Pago, transferencias), tarjetas de crédito y débito, y pago en efectivo.
                    </div>
                </div>
            </div>

            <!-- Envíos y entregas -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#envios"
                        aria-expanded="false"
                        aria-controls="envios">
                        Envíos y entregas
                    </button>
                </h2>
                <div id="envios" class="accordion-collapse collapse"
                    data-bs-parent="#accordionComercializacion">
                    <div class="accordion-body">
                        Realizamos envíos a domicilio y puntos de retiro. También podés coordinar entrega personalizada según tu ubicación.
                    </div>
                </div>
            </div>

            <!-- Políticas -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#politicas"
                        aria-expanded="false"
                        aria-controls="politicas">
                        Políticas de entrega, cambios y garantía
                    </button>
                </h2>
                <div id="politicas" class="accordion-collapse collapse"
                    data-bs-parent="#accordionComercializacion">
                    <div class="accordion-body">
                        Podés solicitar cambios o devoluciones dentro del plazo establecido. Todos los productos cuentan con garantía según el tipo de artículo.
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

</x-layout>