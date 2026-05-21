<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Panel Admin' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2">
        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center" href="/admin">
                <img src="{{ asset('img/logo1.png') }}" width="180">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse align-items-center" id="adminNavbar">

                <!-- IZQUIERDA -->
                <ul class="navbar-nav me-auto align-items-center">

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center" href="/admin">
                            DASHBOARD
                        </a>
                    </li>

    <li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle"
       href="#"
       id="productosDropdown"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">
        PRODUCTOS
    </a>

    <ul class="dropdown-menu dropdown-menu-dark">

        <li>
            <a class="dropdown-item"
               href="/admin/productos">
                VER PRODUCTOS
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="/admin/productos/crear">
                REGISTRAR PRODUCTO
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="/admin/productos/baja">

                DAR DE BAJA UN PRODUCTO

            </a>
        </li>

    </ul>

</li>

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center" href="/admin/contactos">
                            CONSULTAS
                        </a>
                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link d-flex align-items-center" href="/">
                            VER SITIO
                        </a>
                    </li>

                </ul>

                <!-- DERECHA -->
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item me-3 d-flex align-items-center">
                        <div class="d-flex align-items-center text-white">

                            <div class="rounded-circle bg-light text-dark d-flex align-items-center justify-content-center me-2"
                                 style="width: 36px; height: 36px; font-size: 18px;">
                                👤
                            </div>

                            <div class="lh-sm">
                                <small class="text-white-50 d-block">ADMIN</small>
                                <strong>{{ auth()->user()->name }}</strong>
                            </div>

                        </div>
                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <form action="{{ route('logout') }}" method="POST" class="m-0 d-flex align-items-center">
                            @csrf

                            <button type="submit" class="btn btn-outline-light btn-sm rounded-pill px-3">
                                Cerrar sesión
                            </button>
                        </form>
                    </li>

                </ul>

            </div>

        </div>
    </nav>
</header>

<main>
    {{ $slot }}
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>