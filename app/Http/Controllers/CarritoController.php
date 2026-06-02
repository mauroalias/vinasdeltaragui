<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;

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

        if (empty($carrito)) {
            return redirect('/catalogo')->with('mensaje', 'Tu carrito está vacío. Agregá productos para poder finalizar una compra.');
        }

        $subtotal = 0;
        foreach ($carrito as $item) {
            $subtotal += $item['precio'] * $item['cantidad'];
        }

        $total = $subtotal;

        return view('frontend.finalizar-compra', compact('carrito', 'subtotal', 'total'));
    }

   public function procesarCompra(Request $request)
{
    $carrito = session('carrito', []);

    if (empty($carrito)) {
        return redirect('/catalogo');
    }

    // Calcular total
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // Crear la cabecera de la venta
    $venta = VentaCabecera::create([
        'user_id'     => auth()->id(),
        'estado'      => 'confirmado',
        'total'       => $total,
        'fecha_venta' => now(),
    ]);

    // Guardar cada producto como detalle
    foreach ($carrito as $item) {

    $producto = Producto::find($item['id']);

    if (!$producto || $producto->stock < $item['cantidad']) {

        return back()->with(
            'error',
            'No hay stock suficiente de ' . $item['nombre']
        );
    }

    VentaDetalle::create([
        'venta_id'        => $venta->id,
        'producto_id'     => $item['id'],
        'nombre_producto' => $item['nombre'],
        'cantidad'        => $item['cantidad'],
        'precio_unitario' => $item['precio'],
        'subtotal'        => $item['precio'] * $item['cantidad'],
    ]);

    $producto->stock -= $item['cantidad'];
    $producto->save();
}

    // Vaciar el carrito de sesión
    session()->forget('carrito');

    // Redirigimos al comprobante nuevo pasando el ID
    return redirect('/comprobante/' . $venta->id)->with('mensaje', '¡Compra realizada con éxito!');
}

    public function sumar($clave)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$clave])) {
            // Buscamos el producto real en la base de datos para consultar el stock
            $producto = Producto::find($clave);
            
            // Verificamos que el producto exista y que lo que hay en el carrito sea MENOR al stock real
            if ($producto && $carrito[$clave]['cantidad'] < $producto->stock) {
                $carrito[$clave]['cantidad']++;
                session()->put('carrito', $carrito);
            } else {
                // Capturamos el nombre exacto del producto desde el carrito
                $nombreProducto = $carrito[$clave]['nombre'] ?? 'este producto';
                
                // Lo inyectamos en el mensaje
                return back()->with('error', '¡Stock máximo alcanzado para ' . $nombreProducto . '!');
            }
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

    public function vaciar()
    {
        // Esto borra todo el carrito de la memoria del navegador
        session()->forget('carrito');
        
        return redirect('/catalogo')->with('mensaje', 'El carrito ha sido vaciado.');
    }

    public function exito()
    {
        
        session()->forget('carrito');

        return view('frontend.exito', [
            'titulo' => '¡Pedido Confirmado!',
            'mensaje' => 'Tu pedido fue registrado y pagado correctamente. Nos comunicaremos para coordinar la entrega.'
        ]);
    }

    public function comprobante($id)
    {
        // Buscar la venta y sus detalles en la BD
        $pedido = VentaCabecera::with('detalles')->findOrFail($id);

        // Evitar que un usuario vea facturas de otro modificando la URL
        if ($pedido->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver este comprobante.');
        }

        return view('frontend.factura', compact('pedido'));
    }
}