<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CatalogoController;

class CarritoController extends Controller
{
    public function agregar(Request $request, $tipo, $id)
    {
        $catalogo = new CatalogoController();
        $productos = $catalogo->obtenerProductos();

        if (!isset($productos[$tipo][$id])) {
            abort(404);
        }

        $producto = $productos[$tipo][$id];
        $cantidad = (int) $request->input('cantidad', 1);

        if ($cantidad < 1) {
            $cantidad = 1;
        }

        if ($cantidad > $producto['stock']) {
            $cantidad = $producto['stock'];
        }

        $carrito = session()->get('carrito', []);
        $clave = $tipo . '-' . $id;

        if (isset($carrito[$clave])) {
            $carrito[$clave]['cantidad'] += $cantidad;
        } else {
            $carrito[$clave] = [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad,
                'imagen' => $producto['imagen'],
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

        return view('frontend.exito', [
            'titulo' => 'Compra iniciada',
            'mensaje' => 'Tu pedido fue registrado correctamente. Nos comunicaremos para coordinar el pago y la entrega.'
        ]);
    }
}