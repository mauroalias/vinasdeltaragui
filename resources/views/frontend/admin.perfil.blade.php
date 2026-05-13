<x-layout title="Panel Administrador">

<div class="container my-5">

    <div class="barra-productos mb-5">
        <h2>PANEL ADMINISTRADOR</h2>
    </div>

    <div class="card p-4 sombra-hover">
        <p><strong>Bienvenido:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Rol:</strong> {{ auth()->user()->rol }}</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                Cerrar sesión
            </button>
        </form>
    </div>

</div>

</x-layout>