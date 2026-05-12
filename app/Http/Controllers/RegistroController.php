<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistroRequest;
use App\Models\Registro;
use Carbon\Carbon;

class RegistroController extends Controller
{
    public function store_registro(RegistroRequest $request)
    {

        $datos = $request->validated();

        $nombre=$datos['nombre'];
        $email=$datos['correo'];
        $fecha_nacimiento=$datos['fecha_nacimiento'];
        $password=$datos['password'];

        Registro::create([
        'nombre'   => $datos['nombre'],
        'email'    => $datos['correo'],
        'fecha_nacimiento'   => $datos['fecha_nacimiento'],
        'password' => $datos['password'],
    ]);

        return redirect()->back()->with('success_message','¡Usuario registrado!');
    }
}


