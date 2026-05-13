<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioSesionController extends Controller
{
    public function iniciosesion(Request $request)
    {
        $credenciales = $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ], [
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingresá un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $login = Auth::attempt([
            'email' => $credenciales['correo'],
            'password' => $credenciales['password'],
        ]);

        if (!$login) {

            return back()->withErrors([
                'correo' => 'El correo o la contraseña no son correctos.',
            ])->withInput();
        }

        $request->session()->regenerate();

        if (Auth::user()->rol === 'admin') {
            return redirect('/admin/perfil');
        }

        return redirect('/perfil');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}