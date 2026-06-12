<x-admin-layout title="Panel Administrador">

<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

<div class="container py-5">

    <div class="mb-5 text-center">
        <h1 class="fw-bold text-dark">Consultas</h1>
        <p class="text-muted mb-0 fs-5">Gestión y seguimiento de mensajes de usuarios</p>
    </div>

    @if($contactos->count() > 0)

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

        <div class="card-header bg-dark text-white py-3 d-flex align-content-center justify-content-between">
            <h5 class="mb-0 align-self-center">Bandeja de entrada</h5>
            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 small">
                {{ $contactos->count() }} {{ $contactos->count() == 1 ? 'consulta' : 'consultas' }}
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase fs-7 text-muted" style="letter-spacing: 0.5px;">
                    <tr>
                        <th class="ps-4">Nombre</th>
                        <th>Email</th>
                        <th>Motivo</th>
                        <th style="width: 40%;">Consulta</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contactos as $contacto)
                    <tr class="{{ !$contacto->leido ? 'fila-nueva' : 'fila-leida' }}">

                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-2">
                                <span class="{{ !$contacto->leido ? 'fw-bold text-dark' : 'fw-semibold text-secondary' }}">
                                    {{ $contacto->nombre }}
                                </span>
                                @if(!$contacto->leido)
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 font-monospace" style="font-size: 0.65rem;">
                                        NUEVO
                                    </span>
                                @endif
                            </div>
                        </td>

                        <td>
                            <a href="mailto:{{ $contacto->email }}" class="text-decoration-none {{ !$contacto->leido ? 'text-dark fw-medium' : 'text-muted' }}">
                                {{ $contacto->email }}
                            </a>
                        </td>

                        <td>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium">
                                {{ $contacto->motivo }}
                            </span>
                        </td>

                        <td>
                            <div class="text-muted" style="font-size: 0.93rem; line-height: 1.5;">
                                @if(strlen($contacto->consulta) > 80)
                                    <span id="resumen-{{ $contacto->id }}">
                                        {{ Str::limit($contacto->consulta, 80, '...') }}
                                    </span>
                                    <span id="completo-{{ $contacto->id }}" class="d-none">
                                        {{ $contacto->consulta }}
                                    </span>
                                    <button type="button" class="btn btn-link btn-sm p-0 ms-1 fw-semibold text-primary text-decoration-none btn-toggle-texto" data-id="{{ $contacto->id }}" style="font-size: 0.85rem;">
                                        Ver más &darr;
                                    </button>
                                @else
                                    {{ $contacto->consulta }}
                                @endif
                            </div>
                        </td>

                        <td class="text-end pe-4">
                            <form action="{{ route('admin.contactos.alternar', $contacto->id) }}" method="POST" class="d-inline">
                                @csrf
                                @if($contacto->leido)
                                    <button type="submit" class="btn btn-sm bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 btn-accion text-nowrap" title="Marcar como no leído" style="font-size: 0.8rem; letter-spacing: 0.2px;">
                                         Marcar sin leer
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-outline-success px-3 rounded-pill fw-semibold btn-accion text-nowrap" style="font-size: 0.85rem; letter-spacing: 0.3px;">
                                         Marcar leído
                                    </button>
                                @endif
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @else

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body text-center py-5">
            <h4 class="text-dark mb-2">Bandeja de entrada limpia</h4>
            <p class="text-muted mb-0">No tenés consultas pendientes de responder en este momento.</p>
        </div>
    </div>

    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-toggle-texto').forEach(boton => {
            boton.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const resumen = document.getElementById(`resumen-${id}`);
                const completo = document.getElementById(`completo-${id}`);

                if (completo.classList.contains('d-none')) {
                    completo.classList.remove('d-none');
                    resumen.classList.add('d-none');
                    this.innerHTML = 'Ver menos &uarr;';
                } else {
                    completo.classList.add('d-none');
                    resumen.classList.remove('d-none');
                    this.innerHTML = 'Ver más &darr;';
                }
            });
        });
    });
</script>

</x-admin-layout>