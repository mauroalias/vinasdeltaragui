<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function store_registro(RegistroRequest $request)
    {
        $datos = $request->validated();

        $user = User::create([
            'name' => $datos['nombre'],
            'email' => $datos['correo'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'],
            'password' => $datos['password'],
            'rol' => 'cliente',
        ]);

        Auth::login($user);

        return redirect('/perfil')->with('success_message', '¡Usuario registrado!');
    }
}