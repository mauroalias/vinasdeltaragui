<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class RegistroController extends Controller
{
    public function registro(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'fecha_nacimiento' => 'required|date',
            'password' => 'required|min:6|confirmed',
        ], [
            'nombre.required' => 'El nombre y apellido es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingresá un correo electrónico válido.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'Ingresá una fecha de nacimiento válida.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $edad = Carbon::parse($request->fecha_nacimiento)->age;

        if ($edad < 18) {
            return back()->withErrors([
                'fecha_nacimiento' => 'Debés ser mayor de 18 años para registrarte.'
            ])->withInput();
        }

        session()->put('registrado', true);

        return view('frontend.exito', [
            'titulo' => 'Registro exitoso',
            'mensaje' => 'Tu cuenta fue creada correctamente. Ahora debés iniciar sesión para finalizar una compra.'
        ]);
    }
}