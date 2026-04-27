<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function procesar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'consulta' => 'required',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'Ingresá un correo válido.',
            'consulta.required' => 'La consulta no puede estar vacía.',
        ]);

        return view('frontend.exito', [
            'titulo' => '¡Consulta enviada!',
            'mensaje' => 'Gracias por contactarte. Te responderemos a la brevedad.'
        ]);
    }
}