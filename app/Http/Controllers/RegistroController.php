<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function store_registro(RegistroRequest $request)
    {
        $datos = $request->validated();

        User::create([
            'name' => $datos['nombre'],
            'email' => $datos['correo'],
            'fecha_nacimiento' => $datos['fecha_nacimiento'],
            'password' => Hash::make($datos['password']),
            'rol' => 'cliente',
        ]);

        return redirect('/iniciosesion')->with(
            'success_message',
            '¡Usuario registrado correctamente! Ahora iniciá sesión.'
        );
    }
}