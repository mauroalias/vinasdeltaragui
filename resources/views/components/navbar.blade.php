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
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            CATÁLOGO
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">VINOS</a></li>
                            <li><a class="dropdown-item" href="#">WHISKYS</a></li>
                            <li><a class="dropdown-item" href="#">OTROS</a></li>
                        </ul>
                    </li>

                </ul>

                <!-- DERECHA -->
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item">
                        <a class="nav-link" href="/registro">REGISTRARSE</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/iniciosesion">INICIAR SESIÓN</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            🛒 <span class="badge bg-danger">0</span>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
</header>