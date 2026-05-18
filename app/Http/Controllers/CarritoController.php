<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function agregar(Request $request, $tipo, $id)
    {
        $producto = Producto::where('id', $id)
            ->where('activo', true)
            ->firstOrFail();

        $cantidad = (int) $request->input('cantidad', 1);

        if ($cantidad < 1) {
            $cantidad = 1;
        }

        if ($cantidad > $producto->stock) {
            $cantidad = $producto->stock;
        }

        $carrito = session()->get('carrito', []);

        $clave = $producto->id;

        if (isset($carrito[$clave])) {
            $carrito[$clave]['cantidad'] += $cantidad;

            if ($carrito[$clave]['cantidad'] > $producto->stock) {
                $carrito[$clave]['cantidad'] = $producto->stock;
            }
        } else {
            $carrito[$clave] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $cantidad,
                'imagen' => $producto->url_imagen,
                'tipo' => $tipo,
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('carrito_abierto', true);
    }

    public function eliminar($clave)
    {
        $carrito = session()->get('carrito', []);

        unset($carrito[$clave]);

        session()->put('carrito', $carrito);

        return back()->with('carrito_abierto', true);
    }

    public function finalizar()
    {
        if (!auth()->check()) {
            return redirect('/iniciosesion')
                ->with('mensaje', 'Para finalizar la compra primero debés iniciar sesión.');
        }

        session()->forget('carrito');

        return view('frontend.exito', [
            'titulo' => 'Compra iniciada',
            'mensaje' => 'Tu pedido fue registrado correctamente. Nos comunicaremos para coordinar el pago y la entrega.'
        ]);
    }
}