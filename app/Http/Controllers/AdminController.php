<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use App\Models\VentaCabecera;

class AdminController extends Controller
{
    private function verificarAdmin()
    {
        if (!auth()->check() || auth()->user()->rol !== 'admin') {
            abort(403);
        }
    }

    public function dashboard()
    {
        $this->verificarAdmin();

        return view('backend.admin.dashboard', [
            'totalUsuarios' => User::count(),
            'totalProductos' => Producto::count(),
            'totalContactos' => Contacto::count(),
            
            
            'usuarios' => User::with(['datosFacturacion', 'ventas'])->get(),
        ]); 
    }

    public function verCliente($id)
    {
        $this->verificarAdmin();

        $cliente = User::with(['datosFacturacion', 'ventas' => function ($query) {
            $query->orderBy('fecha_venta', 'desc');
        }])->findOrFail($id);

        return view('backend.admin.cliente-historial', compact('cliente'));
    }

    public function historialVentas(Request $request)
{
    $this->verificarAdmin();

    $query = VentaCabecera::with(['usuario', 'detalles'])
        ->where('estado', 'confirmado');

    if ($request->filled('buscar')) {
        $buscar = $request->input('buscar');
        
        $query->where(function($q) use ($buscar) {
            $q->where('id', $buscar)
              ->orWhereHas('usuario', function($u) use ($buscar) {
                  $u->where('name', 'like', "%{$buscar}%")
                    ->orWhere('email', 'like', "%{$buscar}%");
              });
        });
    }

    $ventas = $query->latest('fecha_venta')->paginate(15);

    return view('backend.admin.ventas-historial', compact('ventas'));
}
    public function productos()
{
    $this->verificarAdmin();

    return view('backend.admin.productos', [
        'productos' => Producto::with('categoria')
            ->orderBy('id')
            ->get(),
    ]);
}

    public function crearProducto()
    {
        $this->verificarAdmin();

        return view('backend.admin.crear-producto', [
            'categorias' => Categoria::all(),
        ]);
    }

    public function guardarProducto(ProductoRequest $request)
{
    $this->verificarAdmin();

    $datos = $request->validated();

    if ($request->hasFile('url_imagen')) {

        $imagen = $request->file('url_imagen');

        $nombreImagen =
            time() . '_' . $imagen->getClientOriginalName();

        $imagen->move(
            public_path('img/catalogoproductos'),
            $nombreImagen
        );

        $datos['url_imagen'] =
            'catalogoproductos/' . $nombreImagen;
    }

    Producto::create($datos);

    return redirect('/admin/productos')
        ->with(
            'success_message',
            'Producto registrado correctamente.'
        );
}

    public function contactos()
    {
        $this->verificarAdmin();

        return view('backend.admin.contactos', [
            'contactos' => Contacto::latest()->get(),
        ]);
    }

    public function vistaBajaProducto()
{
    $this->verificarAdmin();

    $productos = Producto::where('activo',1)
                    ->orderBy('id')
                    ->get();

    return view(
        'backend.admin.baja-productos',
        compact('productos')
    );
}

    public function darDeBajaProducto(Request $request)
    {
        $this->verificarAdmin();

        $request->validate([
            'id' => 'required|integer|min:1|exists:productos,id',
        ], [
            'id.required' => 'Debes ingresar el ID del producto.',
            'id.integer'  => 'El ID debe ser un número entero.',
            'id.min'      => 'El ID debe ser un número válido mayor a 0.',
            'id.exists'   => 'El ID ingresado no coincide con ningún producto registrado.',
        ]);

        $producto = Producto::findOrFail($request->id);

        if ($producto->activo == 0) {
            return redirect()->back()
                ->withErrors(['id' => 'Este producto ya se encuentra dado de baja actualmente.'])
                ->withInput();
        }

        $producto->activo = 0;
        $producto->save();

        return redirect()
            ->back()
            ->with(
                'success',
                'El producto "' . $producto->nombre . '" se dio de baja correctamente.'
            );
    }

    public function reactivarProducto(Request $request)
{
    $this->verificarAdmin();

    $request->validate([
        'id' => 'required|exists:productos,id',
    ]);

    $producto = Producto::findOrFail($request->id);

    $producto->activo = 1;

    $producto->save();

    return redirect()
        ->back()
        ->with(
            'success_message',
            'Producto reactivado correctamente'
        );
}


    public function editarProducto($id)
{
    $this->verificarAdmin();

    return view(
        'backend.admin.editar-producto',
        [
            'producto' => Producto::findOrFail($id),
            'categorias' => Categoria::all(),
        ]
    );
}

public function actualizarProducto(ProductoRequest $request, $id) 
{
    $this->verificarAdmin();
    $producto = Producto::findOrFail($id);
    $datos = $request->validated(); 

    if ($request->hasFile('url_imagen')) {
        $imagen = $request->file('url_imagen');
        $nombreImagen = time().'_'.$imagen->getClientOriginalName();
        $imagen->move(public_path('img/catalogoproductos'), $nombreImagen);
        $datos['url_imagen'] = 'catalogoproductos/'.$nombreImagen;
    } else {
        unset($datos['url_imagen']);
    }

    $producto->update($datos);

    return redirect('/admin/productos')->with('success_message', 'Producto actualizado correctamente.');
}

public function alternarLeido($id)
{
    $this->verificarAdmin();

    $contacto = Contacto::findOrFail($id);
    $contacto->leido = !$contacto->leido; 
    $contacto->save();

    return redirect()->back()->with('success_message', 'Estado de la consulta actualizado correctamente.');
}
}