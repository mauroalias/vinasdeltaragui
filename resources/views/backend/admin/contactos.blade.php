<x-admin-layout title="Panel Administrador">

<div class="container py-5">

    <div class="mb-5 text-center">

        <h1 class="fw-bold">
            Consultas
        </h1>

        <p class="text-muted mb-0">
            Visualizá las consultas enviadas por los usuarios
        </p>

    </div>

    @if($contactos->count() > 0)

    <div class="card shadow border-0 rounded-4 overflow-hidden">

        <div class="card-header bg-dark text-white py-3">

            <h5 class="mb-0">
                Consultas recibidas
            </h5>

        </div>

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>Nombre</th>

                        <th>Email</th>

                        <th>Motivo</th>

                        <th>Consulta</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($contactos as $contacto)

                    <tr>

                        <td class="fw-semibold">

                            {{ $contacto->nombre }}

                        </td>

                        <td>

                            {{ $contacto->email }}

                        </td>

                        <td>

                            <span class="badge bg-primary rounded-pill px-3 py-2">

                                {{ $contacto->motivo }}

                            </span>

                        </td>

                        <td style="max-width: 350px;">

                            <div class="text-muted">

                                {{ $contacto->consulta }}

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    @else

    <div class="card shadow border-0 rounded-4">

        <div class="card-body text-center py-5">

            <h4 class="mb-3">
                No hay consultas registradas
            </h4>

            <p class="text-muted mb-0">
                Cuando los usuarios envíen consultas aparecerán aquí.
            </p>

        </div>

    </div>

    @endif

</div>

</x-admin-layout>