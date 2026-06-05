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
    $datos = auth()->user()->datosFacturacion()->firstOrCreate(
        ['user_id' => auth()->id()]
    );

    if ($request->filled('direccion')) {
        $datos->direccion = $request->direccion;
    }

    if ($request->filled('telefono')) {
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