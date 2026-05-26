<x-admin-layout title="Panel Administrador">

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold">
                Panel de Administración
            </h1>

            <p class="text-muted">
                Bienvenido {{ auth()->user()->name }}
            </p>
        </div>

        <span class="badge bg-danger fs-6">
            ADMIN
        </span>

    </div>

    <div class="row">

        <div class="col-md-4 mb-4">

            <div class="card shadow border-0 p-4">

                <h2>{{ $totalUsuarios }}</h2>

                <p class="text-muted">
                    Usuarios registrados
                </p>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow border-0 p-4">

                <h2>{{ $totalProductos }}</h2>

                <p class="text-muted">
                    Productos
                </p>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow border-0 p-4">

                <h2>{{ $totalContactos }}</h2>

                <p class="text-muted">
                    Consultas
                </p>

            </div>

        </div>

    </div>

    <div class="card shadow border-0 mt">

    <div class="card-header bg-dark text-white">

        Clientes registrados

    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Nombre</th>

                    <th>Email</th>

                    <th>Rol</th>

                </tr>

            </thead>

            <tbody>

                @foreach($usuarios as $usuario)

                <tr>

                    <td>

                        {{ $usuario->id }}

                    </td>

                    <td>

                        {{ $usuario->name }}

                    </td>

                    <td>

                        {{ $usuario->email }}

                    </td>

                    <td>

                        @if($usuario->rol === 'admin')

                            <span class="badge bg-danger">

                                Admin

                            </span>

                        @else

                            <span class="badge bg-primary">

                                Cliente

                            </span>

                        @endif

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-dark text-white">
            Accesos rápidos
        </div>
    
        <div class="card-body">

            <a href="/admin/productos"
               class="btn btn-primary me-2">

                Gestionar productos

            </a>

            <a href="/admin/contactos"
               class="btn btn-warning">

                Ver consultas

            </a>

        </div>

    </div>

</div>

</x-admin-layout>