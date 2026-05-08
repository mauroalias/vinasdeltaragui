<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactoRequest;
use App\Models\Contacto;

class ContactoController extends Controller
{

    /*
    public function procesar(Request $request)
    {
                return view('frontend.exito', [
            'titulo' => '¡Consulta enviada!',
            'mensaje' => 'Gracias por contactarte. Te responderemos a la brevedad.'
        ]);
    }

    */

    public function store_contact(ContactoRequest $request){

        $datos = $request->validated();

        $nombre=$datos['nombre'];
        $email=$datos['correo'];
        $motivo=$datos['motivo'];
        $consulta=$datos['consulta'];

        Contacto::create([
        'nombre'   => $datos['nombre'],
        'email'    => $datos['correo'],
        'motivo'   => $datos['motivo'],
        'consulta' => $datos['consulta'],
    ]);

        return redirect()->back()->with('success_message','¡Consulta enviada!');
    }
}