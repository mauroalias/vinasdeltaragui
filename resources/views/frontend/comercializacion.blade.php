<x-layout title="Comercialización">

<div class="container my-5 d-flex justify-content-center">

    <div class="col-md-8">

        <div class="titulo-seccion text-center">
            <h1>Comercialización</h1>
            <p>Formas de pago, envíos y beneficios exclusivos</p>
        </div>

        <div class="accordion shadow-sm" id="accordionComercializacion">

            <!-- Formas de pago -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#pago">
                        Formas de pago
                    </button>
                </h2>
                <div id="pago" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        Aceptamos billeteras virtuales (Mercado Pago, transferencias), tarjetas de crédito y débito, y pago en efectivo.
                    </div>
                </div>
            </div>

            <!-- Envíos -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#envios">
                        Envíos y entregas
                    </button>
                </h2>
                <div id="envios" class="accordion-collapse collapse">
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
                        data-bs-target="#politicas">
                        Políticas de entrega, cambios y garantía
                    </button>
                </h2>
                <div id="politicas" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Podés solicitar cambios o devoluciones dentro del plazo establecido.
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


<!-- 🔥 TÍTULO BENEFICIOS -->
<div class="barra-productos mt-5">
    <h2>BENEFICIOS Y PROMOCIONES</h2>
</div>

<div class="barra-comercial container-fluid py-4">
    <div class="row text-center">

        <div class="col-md-4">
            <i class="fas fa-truck icono-comercial"></i>
            <h5>ENVÍO GRATIS</h5>
            <p>PATAGONIA desde $300.000</p>
        </div>

        <div class="col-md-4">
            <i class="fas fa-credit-card icono-comercial"></i>
            <h5>3 CUOTAS SIN INTERÉS</h5>
            <p>Visa y Mastercard</p>
        </div>

        <div class="col-md-4">
            <i class="fas fa-money-bill-wave icono-comercial"></i>
            <h5>15% OFF TRANSFERENCIA</h5>
            <p>No incluye combos especiales</p>
        </div>

    </div>
</div>


<!-- TÍTULO MEDIOS DE PAGO -->
<div class="barra-productos mt-5">
    <h2>MEDIOS DE PAGO</h2>
</div>
<div class="container seccion-pago text-center">

    <div class="row justify-content-center">

        <div class="col-md-3 col-6 mb-4">
            <div class="card p-3 sombra-hover">
                <i class="fab fa-cc-visa icono-pago"></i>
                <p>Visa</p>
            </div>
        </div>

        <div class="col-md-3 col-6 mb-4">
            <div class="card p-3 sombra-hover">
                <i class="fab fa-cc-mastercard icono-pago"></i>
                <p>Mastercard</p>
            </div>
        </div>

        <div class="col-md-3 col-6 mb-4">
            <div class="card p-3 sombra-hover">
                <i class="fas fa-university icono-pago"></i>
                <p>Transferencia</p>
            </div>
        </div>

        <div class="col-md-3 col-6 mb-4">
            <div class="card p-3 sombra-hover">
                <i class="fas fa-wallet icono-pago"></i>
                <p>Billeteras Virtuales</p>
            </div>
        </div>

    </div>

</div>

</x-layout>