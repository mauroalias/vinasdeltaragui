<x-layout title="Registro">
<div class="container my-5 d-flex justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4">

                <h3 class="text-center mb-4">Registro</h3>

                <form action="/registro" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre y apellido</label>
                        <input type="text" name="nombre" id="nombre" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            Registrarse
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
</x-layout>