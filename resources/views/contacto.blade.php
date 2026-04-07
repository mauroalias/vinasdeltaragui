<form action="{{ url('/contacto') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Correo electrónico</label>
        <input type="email" name="email" class="form-control">
        <div class="form-text">Nunca compartiremos tu email.</div>
    </div>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Mensaje</label>
        <textarea name="mensaje" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
</form>