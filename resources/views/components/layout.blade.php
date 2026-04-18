@props(['title'])
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Viñas del Taragüí' }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- TU CSS -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>

    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>