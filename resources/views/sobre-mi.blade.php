<!DOCTYPE html>
<html>
<head>
    <title>Sobre mí</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Mi Sitio</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/">Inicio</a>
            <a class="nav-link active" href="/sobre-mi">Sobre mí</a>
        </div>
    </div>
</nav>

<!-- CONTAINER + CARD -->
<div class="container mt-4">
    <div class="card">
        <div class="card-body">

            <h1 class="card-title">Sobre mí</h1>

            <p><b>Nombre:</b> Mauro Alías</p>
            <p><b>Edad:</b> 21 años</p>
            <p><b>De dónde soy:</b> Corrientes, Argentina</p>
            <p><b>Me gustaría trabajar en:</b> ...</p>
            <p><b>Expectativas del curso:</b> Aprender Laravel</p>
            <p><b>Hobbies:</b> Fútbol y videojuegos</p>

            <!-- BOTONES -->
            <a href="#" class="btn btn-primary mt-3">Descargar CV</a>
            <a href="#" class="btn btn-secondary mt-3">Contactar</a>

        </div>
    </div>
    <div class="card mt-4">
<div class="card-body">
<h2>Formulario de contacto</h2>
<form>
<div class="mb-3">
<label class="form-label">Nombre</label>
<input type="text" class="form-control" placeholder="Ingrese su nombre">
</div>
<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" class="form-control" placeholder="Ingrese su email">
</div>
<div class="mb-3">
<label class="form-label">Mensaje</label>
<textarea class="form-control" rows="3"></textarea>
</div>
<button type="submit" class="btn btn-success">
Enviar mensaje
</button>
</form>
</div>
</div>
</div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>