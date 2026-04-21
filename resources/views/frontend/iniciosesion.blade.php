<x-layout title="Iniciar Sesión">

<div class="container my-5 d-flex justify-content-center">

    <div class="col-md-5">

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">

                <h3 class="text-center mb-4">Iniciar sesión</h3>

                <form action="/iniciosesion" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control rounded-3" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="recordarme">
                            <label class="form-check-label" for="recordarme">
                                Recordarme
                            </label>
                        </div>

                        <a href="#" class="text-decoration-none small">¿Olvidaste tu contraseña?</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            Iniciar sesión
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

</x-layout>