<x-layout title="Inicio">

<section>

    <!-- CARRUSEL -->
   <div id="carouselExample" class="carousel slide mt-5 mb-5" style="margin-bottom: 120px;">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('img/imagen1.png') }}" class="d-block w-100">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('img/imagen2.png') }}" class="d-block w-100">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('img/imagen3.png') }}" class="d-block w-100">
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    

    <!-- CARDS -->
    <div class="barra-productos">
        <h2>NUESTROS PRODUCTOS</h2>
    </div>
    <div class="container mb-5">
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('img/imagen5.jpg') }}" 
                    class="card-img-top"
                    style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">VINOS</h5>
                        <p class="card-text">Una cuidada selección de etiquetas de las mejores bodegas para acompañar tus grandes momentos.</p>
                        <a href="/catalogo/vinos" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('img/imagen6.jpg') }}" 
                    class="card-img-top"
                    style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">WHISKYS</h5>
                        <p class="card-text">Carácter y distinción absoluta. Descubre maltas excepcionales y blends de prestigio mundial.</p>
                        <a href="/catalogo/whiskys" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('img/imagen7.jpg') }}" 
                    class="card-img-top"
                    style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">OTROS</h5>
                        <p class="card-text">Desde destilados premium hasta licores dulces. Todo lo que necesitas para armar la barra perfecta.</p>
                        <a href="/catalogo/otros" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- IMAGEN FINAL -->
     <div class="barra-productos">
        <h2>ÚLTIMO LANZAMIENTO</h2>
    </div>
    <div class="mb-5">
        <img src="{{ asset('img/imagen4.png') }}" class="w-100">
    </div>

</section>

</x-layout>