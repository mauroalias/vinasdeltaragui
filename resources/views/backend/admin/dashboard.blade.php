<x-admin-layout title="Panel Administrador">

<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

<div class="container my-5" style="max-width: 1100px;">

    {{-- ENCABEZADO --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
        <div>
            <h4 class="fw-bold mb-1" style="color: #212529; letter-spacing: -0.5px;">Panel de Administración</h4>
            <p class="text-muted mb-0" style="font-size: 0.85rem;">Bienvenido, {{ auth()->user()->name }}</p>
        </div>
        <span class="badge rounded-pill px-3 py-2" style="background-color: #f8f9fa; color: #495057; border: 1px solid #dee2e6; font-size: 0.72rem; letter-spacing: 0.08em; text-transform: uppercase;">
            Administrador
        </span>
    </div>

    {{-- TARJETAS DE ESTADÍSTICAS --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-box border shadow-sm" style="background: #fff;">
                <div class="stat-num">{{ $totalUsuarios }}</div>
                <div class="stat-label">Usuarios registrados</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-box border shadow-sm" style="background: #fff;">
                <div class="stat-num">{{ $totalProductos }}</div>
                <div class="stat-label">Productos</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-box border shadow-sm" style="background: #fff;">
                <div class="stat-num">{{ $totalContactos }}</div>
                <div class="stat-label">Consultas</div>
            </div>
        </div>
    </div>

    {{-- LISTA DE CLIENTES Y SUS HISTORIALES --}}
    <div class="card perfil-card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center seccion-titulo">
            <span>Directorio de Clientes</span>
        </div>

        <div class="table-responsive">
            <table class="table historial-table mb-0" style="min-width: 800px;">
                <thead>
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 25%;">Cliente</th>
                        <th style="width: 30%;">Contacto y Entrega</th>
                        <th style="width: 25%;">Resumen Compras</th>
                        <th style="width: 15%; text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        @if($usuario->rol !== 'admin')
                            <tr>
                                <td class="text-muted">{{ $usuario->id }}</td>
                                <td>
                                    <p class="mb-0 fw-bold" style="font-size: 0.95rem;">{{ $usuario->name }}</p>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem;">{{ $usuario->email }}</p>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <span style="font-size: 0.85rem;">
                                            <i class="fas fa-phone text-muted me-1" style="width: 15px;"></i> 
                                            {{ $usuario->datosFacturacion->telefono ?? 'Sin teléfono' }}
                                        </span>
                                        <span style="font-size: 0.85rem;">
                                            <i class="fas fa-map-marker-alt text-muted me-1" style="width: 15px;"></i> 
                                            {{ $usuario->datosFacturacion->direccion ?? 'Sin dirección' }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $cantidadCompras = isset($usuario->ventas) ? $usuario->ventas->count() : 0;
                                        $totalGastado = isset($usuario->ventas) ? $usuario->ventas->sum('total') : 0;
                                    @endphp
                                    <p class="mb-0" style="font-size: 0.85rem;"><strong>{{ $cantidadCompras }}</strong> pedido/s</p>
                                    <p class="text-success mb-0 fw-bold" style="font-size: 0.85rem;">
                                        ${{ number_format($totalGastado, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td class="text-end">
                                    <a href="/admin/clientes/{{ $usuario->id }}" class="btn btn-sm btn-outline-dark rounded-2" style="font-size:0.75rem;">
                                        Ver Historial
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

    {{-- ACCESOS RÁPIDOS --}}
    <div class="card perfil-card p-4">
        <p class="seccion-titulo">Accesos rápidos</p>
        <div class="d-flex flex-wrap gap-3">
            <a href="/admin/productos" class="btn btn-outline-dark rounded-2 px-4" style="font-size: 0.85rem; padding-top: 0.6rem; padding-bottom: 0.6rem; font-weight: 500;">
                Gestionar productos
            </a>
            <a href="/admin/contactos" class="btn btn-outline-dark rounded-2 px-4" style="font-size: 0.85rem; padding-top: 0.6rem; padding-bottom: 0.6rem; font-weight: 500;">
                Ver consultas
            </a>
        </div>
    </div>

</div>

</x-admin-layout>