<x-layout title="Mi Perfil">

<div class="container my-5">

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            La contraseña fue actualizada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <strong>Error al modificar los datos:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">

        <div class="col-md-4">
        <div class="card shadow border-0 rounded-4 p-4 text-center">
        <div class="mx-auto mb-3 rounded-circle bg-dark text-white d-flex align-items-center justify-content-center"
             style="width: 90px; height: 90px; font-size: 36px;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <h3 class="mb-1">{{ auth()->user()->name }}</h3>
        <p class="text-muted mb-2">{{ auth()->user()->email }}</p>

        <span class="badge bg-success mb-3">
            {{ ucfirst(auth()->user()->rol) }}
        </span>

        <button type="button" class="btn btn-dark w-100 rounded-3 mb-2" data-bs-toggle="modal" data-bs-target="#modalModificarContrasena">
            Modificar datos
        </button>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 rounded-3">
                Cerrar sesión
            </button>
        </form>
    </div>
</div>

        <div class="col-md-8">

            <div class="card shadow border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <h4 class="mb-4">Información personal</h4>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Nombre completo</small>
                            <p class="fw-bold mb-0">{{ auth()->user()->name }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Correo electrónico</small>
                            <p class="fw-bold mb-0">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Tipo de perfil</small>
                            <p class="fw-bold mb-0">{{ ucfirst(auth()->user()->rol) }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Miembro desde</small>
                            <p class="fw-bold mb-0">
                                {{ auth()->user()->created_at->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                        <small class="text-muted">Dirección de envío</small>
                            <p class="fw-bold mb-0">
                                {{ auth()->user()->address ?? 'No especificada' }}
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <h4 class="mb-4">Resumen de actividad</h4>

                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="p-3 bg-light rounded-4">
                                <h3 class="mb-0">0</h3>
                                <small class="text-muted">Compras realizadas</small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="p-3 bg-light rounded-4">
                                <h3 class="mb-0">$0</h3>
                                <small class="text-muted">Total gastado</small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="p-3 bg-light rounded-4">
                                <h3 class="mb-0">0</h3>
                                <small class="text-muted">Productos favoritos</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <h4 class="mb-4">Historial de compras</h4>

                    <div class="alert alert-light border rounded-4 mb-0">
                        Todavía no tenés compras registradas.
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
//modificar contraseña
<div class="modal fade" id="modalModificarContrasena" tabindex="-1" aria-labelledby="modalModificarContrasenaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalModificarContrasenaLabel">Modificar contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4">
                <form action="{{ route('profile.update.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="current_password" class="form-label text-muted small">Contraseña actual</label>
                        <input type="password" class="form-control rounded-3" id="current_password" name="current_password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label text-muted small">Nueva contraseña</label>
                        <input type="password" class="form-control rounded-3" id="password" name="password" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label text-muted small">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control rounded-3" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    
                    <button type="submit" class="btn btn-dark w-100 rounded-3">Actualizar contraseña</button>
                </form>
            </div>
            
        </div>
    </div>
</div>

</x-layout>