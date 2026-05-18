<x-layout title="Registro">

<div class="container my-5 d-flex justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-body p-4">

                <h3 class="text-center mb-4">Registro</h3>

                @if(session('mensaje'))
                    <div class="alert alert-warning text-center">
                        {{ session('mensaje') }}
                    </div>
                @endif

                @if(session('success_message'))
                    <div class="alert alert-success text-center">
                        {{ session('success_message') }}
                    </div>
                @endif

                <form action="/registro" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre y apellido</label>

                        <input
                            type="text"
                            name="nombre"
                            id="nombre"
                            class="form-control rounded-3 @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre') }}"
                            required
                        >

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>

                        <input
                            type="email"
                            name="correo"
                            id="correo"
                            class="form-control rounded-3 @error('correo') is-invalid @enderror"
                            value="{{ old('correo') }}"
                            required
                        >

                        @error('correo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>

                        <input
                            type="date"
                            name="fecha_nacimiento"
                            id="fecha_nacimiento"
                            class="form-control rounded-3 @error('fecha_nacimiento') is-invalid @enderror"
                            value="{{ old('fecha_nacimiento') }}"
                            required
                        >

                        @error('fecha_nacimiento')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control rounded-3 @error('password') is-invalid @enderror"
                            required
                        >

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            La contraseña debe tener al menos 8 caracteres.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control rounded-3 @error('password') is-invalid @enderror"
                            required
                        >
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