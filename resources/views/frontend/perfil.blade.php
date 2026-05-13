<x-layout title="Mi Perfil">

<div class="container my-5">

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

</x-layout>