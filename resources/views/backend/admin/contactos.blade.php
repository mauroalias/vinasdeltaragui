<x-admin-layout title="Panel Administrador">

<div class="container my-5">

<h1 class="mb-4">

Consultas recibidas

</h1>

<div class="card shadow border-0">

<table class="table">

<thead class="table-dark">

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

<td>

{{ $contacto->nombre }}

</td>

<td>

{{ $contacto->email }}

</td>

<td>

{{ $contacto->motivo }}

</td>

<td>

{{ $contacto->consulta }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</x-admin-layout>