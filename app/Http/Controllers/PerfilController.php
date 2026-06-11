<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\VentaCabecera;

class PerfilController extends Controller
{

public function index()
{
    $ventas = VentaCabecera::where('user_id', auth()->id())
        ->where('estado', 'confirmado')
        ->with('detalles')
        ->latest('fecha_venta')
        ->get();

    $totalCompras = $ventas->count();
    $totalGastado = $ventas->sum('total');

    $datosFacturacion = auth()->user()->datosFacturacion;

    return view(
    'frontend.perfil',
    compact(
        'ventas',
        'totalCompras',
        'totalGastado',
        'datosFacturacion'
    )
);
}

public function actualizarDatosFacturacion(Request $request)
{
    // 1. Validar los datos
    $request->validate([
        'direccion' => ['nullable', 'string', 'min:5', 'max:255', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\.\,]+$/', 'regex:/[a-zA-ZáéíóúÁÉÍÓÚñÑ]/'],
        'telefono'  => ['nullable', 'string', 'min:10', 'max:15', 'regex:/^(?=.*[0-9])[\+0-9\-\s]+$/'],
    ], [
        'direccion.min'  => 'La dirección debe tener al menos 5 caracteres.',
        'direccion.max'  => 'La dirección es demasiado larga.',
        'direccion.regex' => 'La dirección debe ser un formato válido y contener letras (ej: Av. 9 de Julio 742).',
        'telefono.min'   => 'El teléfono debe tener al menos 10 caracteres.',
        'telefono.max'   => 'El teléfono no puede superar los 15 caracteres.',
        'telefono.regex' => 'El teléfono solo puede contener números, espacios, guiones o el signo +.',
    ]);

    // 2. Lógica para guardar o actualizar
    $datos = auth()->user()->datosFacturacion()->firstOrCreate(
        ['user_id' => auth()->id()]
    );

    if ($request->has('direccion')) {
        $datos->direccion = $request->direccion;
    }

    if ($request->has('telefono')) {
        $datos->telefono = $request->telefono;
    }

    $datos->save();

    return back()->with('success', 'Datos actualizados');
    }

    public function actualizarPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed', 'different:current_password'], 
        ],[
            'current_password' => 'La contraseña actual es obligatoria.',
            'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas nuevas no coinciden.',
            'password.different' => 'La nueva contraseña debe ser distinta a tu contraseña actual.',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'La contraseña actual no es correcta.',
            ]);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('status', 'password-updated');
    }
}