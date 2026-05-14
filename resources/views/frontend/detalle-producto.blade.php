<x-layout title="{{ $producto['nombre'] }}">

<div class="container my-5">

    {{-- DETALLE PRINCIPAL --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5">

        <div class="row g-0 align-items-center">

            <div class="col-lg-6 bg-light text-center p-5">

                <img
                    src="{{ asset('img/' . $producto['imagen']) }}"
                    alt="{{ $producto['nombre'] }}"
                    class="img-fluid producto-detalle-img"
                >

            </div>

            <div class="col-lg-6 p-5">

                <div class="mb-3">
                    <small class="text-uppercase text-muted">
                        Inicio / Catálogo / {{ ucfirst($tipo) }}
                    </small>
                </div>

                <h1 class="fw-bold mb-3 producto-detalle-titulo">
                    {{ $producto['nombre'] }}
                </h1>

                <p class="lead text-muted mb-4">
                    {{ $producto['descripcion'] }}
                </p>

                <h2 class="fw-bold mb-3">
                    ${{ number_format($producto['precio'], 0, ',', '.') }}
                </h2>

                @if($producto['stock'] > 0)
                    <p class="text-success fw-bold mb-4">
                        {{ $producto['stock'] }} unidades disponibles
                    </p>
                @else
                    <p class="text-danger fw-bold mb-4">
                        Producto sin stock
                    </p>
                @endif

                <hr>

                <div class="mb-4">
                    <p class="mb-1">
                        <strong>Categoría:</strong> {{ ucfirst($tipo) }}
                    </p>

                    <p class="mb-1">
                        <strong>Estado:</strong>
                        {{ $producto['stock'] > 0 ? 'Disponible para compra' : 'No disponible' }}
                    </p>

                    <p class="mb-1">
                        <strong>Origen:</strong> Selección premium Viñas del Taragüí
                    </p>
                </div>

                @if($producto['stock'] > 0)

                    <form action="/carrito/agregar/{{ $tipo }}/{{ $id }}" method="POST">

                        @csrf

                        <div class="d-flex align-items-center gap-3 mb-4">

                            <input
                                type="number"
                                name="cantidad"
                                value="1"
                                min="1"
                                max="{{ $producto['stock'] }}"
                                class="form-control text-center"
                                style="width: 100px;"
                            >

                            <button type="submit" class="btn btn-dark btn-lg px-4">
                                🛒 Añadir al carrito
                            </button>

                        </div>

                    </form>

                @else

                    <button class="btn btn-secondary btn-lg" disabled>
                        No disponible
                    </button>

                @endif

            </div>

        </div>

    </div>

    {{-- DESCRIPCIÓN EXTRA --}}
    <div class="row mb-5">

        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold">Calidad seleccionada</h5>
                <p class="text-muted mb-0">
                    Producto elegido para clientes que buscan una experiencia distinguida y confiable.
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold">Compra segura</h5>
                <p class="text-muted mb-0">
                    Agregá el producto al carrito y coordinamos el pago y la entrega de manera personalizada.
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold">Atención personalizada</h5>
                <p class="text-muted mb-0">
                    Te acompañamos en la elección del producto ideal según tus gustos y ocasión.
                </p>
            </div>
        </div>

    </div>

    {{-- RELACIONADOS --}}
    <div class="mb-4 d-flex justify-content-between align-items-center">

        <h2 class="fw-bold">
            Productos relacionados
        </h2>

        <a href="/catalogo/{{ $tipo }}" class="btn btn-outline-dark rounded-pill">
            Ver todos
        </a>

    </div>

    <div id="sliderRelacionados" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">

            @foreach($relacionados->chunk(4) as $grupoIndex => $grupo)

                <div class="carousel-item {{ $grupoIndex === 0 ? 'active' : '' }}">

                    <div class="row">

                        @foreach($grupo as $relacionadoId => $relacionado)

                            <div class="col-md-3 mb-4">

                                <div class="card h-100 border-0 shadow-sm rounded-4 producto-relacionado">

                                    <a href="/catalogo/{{ $tipo }}/{{ $relacionadoId }}" class="text-decoration-none text-dark">

                                        <div class="bg-light text-center p-4 rounded-top-4">
                                            <img
                                                src="{{ asset('img/' . $relacionado['imagen']) }}"
                                                alt="{{ $relacionado['nombre'] }}"
                                                class="img-fluid"
                                                style="height: 220px; object-fit: contain;"
                                            >
                                        </div>

                                        <div class="card-body text-center">

                                            <small class="text-muted text-uppercase">
                                                {{ $tipo }}
                                            </small>

                                            <h6 class="fw-bold mt-2">
                                                {{ $relacionado['nombre'] }}
                                            </h6>

                                            <p class="fw-bold mb-2">
                                                ${{ number_format($relacionado['precio'], 0, ',', '.') }}
                                            </p>

                                        </div>

                                    </a>

                                    <div class="card-footer bg-white border-0 pb-3">

                                        @if($relacionado['stock'] > 0)

                                            <form action="/carrito/agregar/{{ $tipo }}/{{ $relacionadoId }}" method="POST">

                                                @csrf

                                                <input type="hidden" name="cantidad" value="1">

                                                <button class="btn btn-success w-100 rounded-3">
                                                    Añadir al carrito
                                                </button>

                                            </form>

                                        @else

                                            <button class="btn btn-secondary w-100 rounded-3" disabled>
                                                Sin stock
                                            </button>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

        @if($relacionados->count() > 4)

            <button class="carousel-control-prev" type="button" data-bs-target="#sliderRelacionados" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#sliderRelacionados" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
            </button>

        @endif

    </div>

</div>

@include('frontend.carrito-panel')

@if(session('carrito_abierto'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    let carrito = new bootstrap.Offcanvas(document.getElementById('panelCarrito'));
    carrito.show();
});
</script>
@endif

<style>
    .producto-detalle-img {
        max-height: 560px;
        object-fit: contain;
        transition: transform .3s ease;
    }

    .producto-detalle-img:hover {
        transform: scale(1.04);
    }

    .producto-detalle-titulo {
        letter-spacing: .5px;
    }

    .producto-relacionado {
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .producto-relacionado:hover {
        transform: translateY(-6px);
        box-shadow: 0 1rem 2rem rgba(0,0,0,.12) !important;
    }

    .carousel-control-prev {
        left: -50px;
    }

    .carousel-control-next {
        right: -50px;
    }
</style>

</x-layout>