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

    if (str_contains(url()->previous(), 'finalizar-compra')) {
        return back();
    }

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

        $datosFacturacion = auth()->check()
    ? auth()->user()->datosFacturacion
    : null;

        return view('frontend.finalizar-compra', [
    'carrito' => $carrito,
    'subtotal' => $subtotal,
    'total' => $total,
    'datosFacturacion' => $datosFacturacion,
]);
    }

   public function procesarCompra(Request $request){


    $request->validate([
        'tipo_entrega'  => ['required', 'in:retiro,envio'],
        'telefono'      => ['required', 'string', 'min:10', 'max:15', 'regex:/^[\+0-9\-\s]+$/'],
        'pago'          => ['required', 'in:tarjeta,transferencia'],
        'direccion'     => ['required_if:tipo_entrega,envio', 'nullable', 'string', 'min:5', 'max:255', 'regex:/[a-zA-ZáéíóúÁÉÍÓÚñÑ]/'],
        'provincia'     => ['required_if:tipo_entrega,envio', 'nullable', 'string'],
        'codigo_postal' => ['required_if:tipo_entrega,envio', 'nullable', 'string', 'min:4', 'max:8'],
    ], [
        'telefono.required'           => 'El teléfono es obligatorio.',
        'telefono.min'                => 'El teléfono debe tener al menos 10 caracteres.',
        'telefono.regex'              => 'El teléfono tiene un formato inválido.',
        
        'direccion.required_if'       => 'La calle y número son obligatorios para el envío.',
        'direccion.min'               => 'La dirección es muy corta.',
        'direccion.regex'             => 'La dirección debe ser real y contener letras.',
        'provincia.required_if'       => 'Debés seleccionar una provincia de la lista.',
        'codigo_postal.required_if'   => 'El código postal es obligatorio.',
    ]);

    $carrito = session('carrito', []);

    if (empty($carrito)) {
        return redirect('/catalogo');
    }

    foreach ($carrito as $item) {
        $producto = Producto::find($item['id']);
        if (!$producto || $producto->stock < $item['cantidad']) {
            return back()->with('error', 'No hay stock suficiente de ' . $item['nombre']);
        }
    }

    $direccionFinal = null;
    if ($request->input('tipo_entrega') === 'envio') {
        $direccionFinal = $request->input('direccion') . ', ' . 
                          $request->input('provincia') . ' (CP: ' . 
                          $request->input('codigo_postal') . ')';
    }

    $subtotal = 0;
    foreach ($carrito as $item) {
        $subtotal += $item['precio'] * $item['cantidad'];
    }

    $costo_envio = 0;
    if ($request->input('tipo_entrega') === 'envio') {
        $provincia = $request->input('provincia');

        $local = ['Corrientes', 'Chaco'];
        $norte = ['Misiones', 'Formosa', 'Salta', 'Jujuy', 'Tucumán', 'Santiago del Estero', 'Catamarca', 'La Rioja'];
        $medio = ['Buenos Aires', 'Santa Fe', 'Entre Ríos', 'Córdoba', 'La Pampa', 'San Juan', 'San Luis', 'Mendoza'];
        $sur   = ['Neuquén', 'Río Negro', 'Chubut', 'Santa Cruz', 'Tierra del Fuego'];

        if (in_array($provincia, $local)) {
            $costo_envio = 0;
        } elseif (in_array($provincia, $norte)) {
            $costo_envio = 8000; // Precio Zona Norte
        } elseif (in_array($provincia, $medio)) {
            $costo_envio = 12000; // Precio Zona Centro/Medio
        } elseif (in_array($provincia, $sur)) {
            $costo_envio = 15000; // Precio Zona Sur
        } else {
            $costo_envio = 6000; // Valor intermedio
        }

        if ($subtotal > 250000) {
            $costo_envio = 0;
        }
    }

    $total_final = $subtotal + $costo_envio;

    $venta = VentaCabecera::create([
        'user_id'           => auth()->id(),
        'estado'            => 'confirmado',
        'total'             => $total_final, // Guardamos el total CON el envío sumado
        'fecha_venta'       => now(),
        'tipo_entrega'      => $request->input('tipo_entrega'),
        'direccion_envio'   => $direccionFinal, 
        'telefono_contacto' => $request->input('telefono'),
        'costo_envio'       => $costo_envio, // Guardamos cuánto costó el envío
        'metodo_pago'       => $request->input('pago'),
    ]);

    foreach ($carrito as $item) {
        $producto = Producto::find($item['id']);
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

    session()->forget('carrito');
    return redirect('/comprobante/' . $venta->id)->with('mensaje', '¡Compra realizada con éxito!');
}

    public function sumar($clave)
    {
        $carrito = session()->get('carrito', []);
        $mensajeError = null;
        
        if (isset($carrito[$clave])) {
            $producto = Producto::find($clave);
            
            if ($producto && $carrito[$clave]['cantidad'] < $producto->stock) {
                $carrito[$clave]['cantidad']++;
                session()->put('carrito', $carrito);
            } else {
                $nombreProducto = $carrito[$clave]['nombre'] ?? 'este producto';
                $mensajeError = 'Stock máximo alcanzado para ' . $nombreProducto;
            }
        }

        if (str_contains(url()->previous(), 'finalizar-compra')) {
        return $mensajeError ? back()->with('error', $mensajeError) : back();
        }

        if ($mensajeError) {
        return back()->with('error', $mensajeError)->with('carrito_abierto', true);
    }
        
        return back()->with('carrito_abierto', true);
    }

    public function restar($clave)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$clave])) {
            if ($carrito[$clave]['cantidad'] > 1) {
                $carrito[$clave]['cantidad']--;
            } else {
                unset($carrito[$clave]);
            }
            session()->put('carrito', $carrito);
        }

        if (str_contains(url()->previous(), 'finalizar-compra')) {
        return back();
        }
        
        return back()->with('carrito_abierto', true);
    }

    public function vaciar()
    {
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
        $pedido = VentaCabecera::with('detalles', 'usuario')->findOrFail($id);

        if ($pedido->user_id !== auth()->id() && auth()->user()->rol !== 'admin') {
            abort(403, 'No tienes permiso para ver este comprobante.');
        }

        return view('frontend.factura', compact('pedido'));
    }
}