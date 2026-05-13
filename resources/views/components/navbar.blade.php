<header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">

            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('img/logo1.png') }}" width="180">
            </a>

            <!-- BOTÓN RESPONSIVE -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- CONTENIDO -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- IZQUIERDA -->
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="/empresa">NUESTRA EMPRESA</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/comercializacion">COMERCIALIZACIÓN</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            CATÁLOGO <span class="flecha">▾</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/catalogo">TODOS</a></li>
                            <li><a class="dropdown-item" href="/catalogo/vinos">VINOS</a></li>
                            <li><a class="dropdown-item" href="/catalogo/whiskys">WHISKYS</a></li>
                            <li><a class="dropdown-item" href="/catalogo/otros">OTROS</a></li>
                        </ul>
                    </li>

                </ul>

                                <!-- DERECHA DEL NAVBAR-->
                <ul class="navbar-nav ms-auto align-items-center">

                    @auth
                        <li class="nav-item">
                            <button class="btn nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#panelPerfil">
                                MI PERFIL
                            </button>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/registro">REGISTRARSE</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/iniciosesion">INICIAR SESIÓN</a>
                        </li>
                    @endauth

                    <li class="nav-item">
                        <button class="btn nav-link position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#panelCarrito">
                            🛒
                            <span class="badge bg-danger">
                                {{ session('carrito') ? count(session('carrito')) : 0 }}
                            </span>
                        </button>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
</header>

@auth
<div class="offcanvas offcanvas-end" tabindex="-1" id="panelPerfil">

    <div class="offcanvas-header">

        <h5 class="offcanvas-title">
            {{ auth()->user()->rol === 'admin' ? 'Perfil Administrador' : 'Mi Perfil' }}
        </h5>

        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>

    </div>

    <div class="offcanvas-body">

        <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>

        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

        <p><strong>Rol:</strong> {{ auth()->user()->rol }}</p>

        <hr>

        @if(auth()->user()->rol === 'admin')

            <a href="/admin/perfil" class="btn btn-dark w-100 mb-2">
                Ir al panel admin
            </a>

        @else

            <a href="/perfil" class="btn btn-dark w-100 mb-2">
                Ver perfil completo
            </a>

        @endif

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="btn btn-danger w-100">
                Cerrar sesión
            </button>

        </form>

    </div>

</div>
@endauth