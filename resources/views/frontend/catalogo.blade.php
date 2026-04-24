<x-layout title="Catálogo">

<div class="container my-5">

    <div class="barra-productos mb-5">
        <h2>{{ strtoupper($tipo) }}</h2>
    </div>

    <div class="row">

        @foreach($productos as $index => $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 sombra-hover catalogo-card">

                    <div class="contenedor-img">
                        <img src="{{ asset('img/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}">
                    </div>

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $producto['nombre'] }}</h5>
                        <p class="card-text">{{ $producto['descripcion'] }}</p>

                        <p class="fw-bold mb-2">
                            ${{ number_format($producto['precio'], 0, ',', '.') }}
                        </p>

                        @if($producto['stock'] > 0)
                            <p class="text-success fw-bold">STOCK: {{ $producto['stock'] }}</p>

                            <form action="/carrito/agregar/{{ $tipo }}/{{ $index }}" method="POST">
                                @csrf

                                <div class="cantidad-box mb-3">
                                    <button type="button" class="btn-cantidad" onclick="this.nextElementSibling.stepDown()">−</button>

                                    <input type="number" name="cantidad" value="1" min="1" max="{{ $producto['stock'] }}">

                                    <button type="button" class="btn-cantidad" onclick="this.previousElementSibling.stepUp()">+</button>
                                </div>

                                <button type="submit" class="btn btn-success w-100">
                                    🛒 COMPRAR
                                </button>
                            </form>
                        @else
                            <p class="text-danger fw-bold">SIN STOCK</p>
                            <button class="btn btn-secondary w-100" disabled>NO DISPONIBLE</button>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach

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

</x-layout>