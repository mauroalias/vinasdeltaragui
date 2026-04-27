<x-layout title="Éxito">

<div class="container text-center my-5 py-5">
    
    <div class="mb-4">
        <h1 class="display-1 text-success">✓</h1>
    </div>

    <h1 class="mb-3">
        {{ $titulo ?? '¡Operación realizada!' }}
    </h1>

    <p class="lead text-muted mb-5">
        {{ $mensaje ?? 'La acción se completó correctamente.' }}
    </p>

    <div class="d-flex justify-content-center gap-3">
        <a href="/" class="btn btn-outline-secondary px-4">
            Volver al Inicio
        </a>
        <a href="/catalogo" class="btn btn-primary px-4">
            Ver Catálogo
        </a>
    </div>

</div>

</x-layout>