<x-layout title="Mi Perfil">

<link rel="stylesheet" href="{{ asset('css/perfil.css') }}">

<div class="container my-5" style="max-width: 1000px;">

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> Contraseña actualizada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
            <strong>Error:</strong>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4 align-items-start">

        {{-- COLUMNA IZQUIERDA --}}
        <div class="col-md-3">
            <div class="card perfil-card p-4 text-center mb-3">
                <div class="perfil-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <h5 class="fw-bold mb-0">{{ auth()->user()->name }}</h5>
                <p class="text-muted small mb-3">{{ auth()->user()->email }}</p>
                <span class="badge bg-success px-3 py-2 rounded-pill mb-4" style="font-size:0.75rem; letter-spacing:0.04em;">
                    {{ ucfirst(auth()->user()->rol) }}
                </span>
                <button type="button"
                    class="btn btn-dark w-100 rounded-3 mb-2"
                    style="font-size: 0.875rem;"
                    data-bs-toggle="modal"
                    data-bs-target="#modalModificarContrasena">
                    Modificar contraseña
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-3" style="font-size: 0.875rem;">
                        Cerrar sesión
                    </button>
                </form>
            </div>

            <div class="row g-2">
                <div class="col-12">
                    <div class="stat-box">
                        <div class="stat-num">{{ $totalCompras }}</div>
                        <div class="stat-label">Compras</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="stat-box">
                        <div class="stat-num" style="font-size:1.3rem;">${{ number_format($totalGastado, 0, ',', '.') }}</div>
                        <div class="stat-label">Total gastado</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="stat-box">
                        <div class="stat-num" style="font-size:1.1rem;">
                            {{ $ventas->first() ? $ventas->first()->fecha_venta->format('d/m/Y') : '—' }}
                        </div>
                        <div class="stat-label">Última compra</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA --}}
        <div class="col-md-9">

            {{-- Información personal --}}
            <div class="card perfil-card p-4 mb-4">
                <p class="seccion-titulo">Información personal</p>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="info-label">Nombre completo</div>
                        <p class="info-value">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-label">Correo electrónico</div>
                        <p class="info-value">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-label">Miembro desde</div>
                        <p class="info-value">{{ auth()->user()->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-label">Dirección</div>
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <p class="info-value mb-0">{{ $datosFacturacion->direccion ?? 'No especificada' }}</p>
                            <button class="btn btn-sm btn-outline-secondary rounded-2 flex-shrink-0"
                                style="font-size:0.75rem; padding: 2px 10px;"
                                data-bs-toggle="collapse"
                                data-bs-target="#editarDireccion">
                                {{ isset($datosFacturacion->direccion) ? 'Editar' : 'Agregar' }}
                            </button>
                        </div>
                        <div class="collapse mt-2" id="editarDireccion">
                            <form action="{{ route('perfil.facturacion.actualizar') }}" method="POST" class="d-flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="direccion"
                                    class="form-control form-control-sm"
                                    placeholder="Ingresá tu dirección"
                                    value="{{ $datosFacturacion->direccion ?? '' }}">
                                <button type="submit" class="btn btn-dark btn-sm rounded-2 flex-shrink-0">Guardar</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-label">Teléfono</div>
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <p class="info-value mb-0">{{ $datosFacturacion->telefono ?? 'No especificado' }}</p>
                            <button class="btn btn-sm btn-outline-secondary rounded-2 flex-shrink-0"
                                style="font-size:0.75rem; padding: 2px 10px;"
                                data-bs-toggle="collapse"
                                data-bs-target="#editarTelefono">
                                {{ isset($datosFacturacion->telefono) ? 'Editar' : 'Agregar' }}
                            </button>
                        </div>
                        <div class="collapse mt-2" id="editarTelefono">
                            <form action="{{ route('perfil.facturacion.actualizar') }}" method="POST" class="d-flex gap-2">
                                @csrf @method('PUT')
                                <input type="text" name="telefono"
                                    class="form-control form-control-sm"
                                    placeholder="Ingresá tu teléfono"
                                    value="{{ $datosFacturacion->telefono ?? '' }}">
                                <button type="submit" class="btn btn-dark btn-sm rounded-2 flex-shrink-0">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Historial de compras --}}
            <div class="card perfil-card p-4">
                <p class="seccion-titulo">Historial de compras</p>

                @if($ventas->isEmpty())
                    <div class="text-center py-4">
                        <p class="text-muted mb-0" style="font-size:0.9rem;">Todavía no tenés compras registradas.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table historial-table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Productos</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Comprobante</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ventas as $venta)
                                <tr>
                                    <td class="text-muted" style="font-size:0.8rem;">{{ $venta->id }}</td>
                                    <td>{{ $venta->fecha_venta->format('d/m/Y') }}
                                        <span class="text-muted" style="font-size:0.8rem;">{{ $venta->fecha_venta->format('H:i') }}</span>
                                    </td>
                                    <td>{{ $venta->detalles->count() }} producto/s</td>
                                    <td>${{ number_format($venta->total, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-success rounded-pill px-3"
                                            style="font-size:0.72rem; letter-spacing:0.03em;">
                                            {{ ucfirst($venta->estado) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/comprobante/{{ $venta->id }}"
                                            class="btn btn-sm btn-outline-dark rounded-2"
                                            style="font-size:0.8rem;"
                                            target="_blank">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

{{-- Modal contraseña --}}
<div class="modal fade" id="modalModificarContrasena" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Modificar contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('profile.update.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label text-muted small">Contraseña actual</label>
                        <input type="password" class="form-control rounded-3" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small">Nueva contraseña</label>
                        <input type="password" class="form-control rounded-3" name="password" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control rounded-3" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 rounded-3">Actualizar contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>

</x-layout>