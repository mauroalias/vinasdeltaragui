<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioSesionController extends Controller
{
    public function iniciosesion(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ], [
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingresá un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        session()->put('usuario', [
            'correo' => $request->correo,
        ]);

        return view('frontend.exito', [
            'titulo' => 'Inicio de sesión exitoso',
            'mensaje' => 'Bienvenido nuevamente. Ya podés continuar con tu compra.'
        ]);
    }
}