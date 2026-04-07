<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function procesar(Request $request)
    {
        $nombre = $request->input('nombre');
        $email = $request->input('email');

        return view('exito', [
            'nombre' => $nombre,
            'email' => $email
        ]);
    }
}
