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

        $carrito = session('carrito', []);

        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        $total = $subtotal;

        return view('frontend.finalizar-compra', compact('carrito', 'subtotal', 'total'));
    }

    public function procesarCompra(Request $request)
    {
        // Acá a futuro guardarías el pedido en la base de datos (tabla pedidos)
        
        // Como la compra ya se confirmó, AHORA SÍ vaciamos el carrito
        session()->forget('carrito');

       return redirect('/compra-exitosa');
    }

    public function sumar($clave)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$clave])) {
            $carrito[$clave]['cantidad']++;
            session()->put('carrito', $carrito);
        }
        
        return back();
    }

    public function restar($clave)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$clave])) {
            if ($carrito[$clave]['cantidad'] > 1) {
                $carrito[$clave]['cantidad']--;
            } else {
                // Si la cantidad llega a 0, directamente lo sacamos del carrito
                unset($carrito[$clave]);
            }
            session()->put('carrito', $carrito);
        }
        
        return back();
    }

    public function exito()
    {
        
        session()->forget('carrito');

        return view('frontend.exito', [
            'titulo' => '¡Pedido Confirmado!',
            'mensaje' => 'Tu pedido fue registrado y pagado correctamente. Nos comunicaremos para coordinar la entrega.'
        ]);
}
}