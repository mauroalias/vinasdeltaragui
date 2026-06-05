<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;

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

        // Buscamos al usuario y cargamos sus relaciones. 
        // Ordenamos las ventas de la más nueva a la más vieja.
        $cliente = User::with(['datosFacturacion', 'ventas' => function ($query) {
            $query->orderBy('fecha_venta', 'desc');
        }])->findOrFail($id);

        return view('backend.admin.cliente-historial', compact('cliente'));
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
            'img/catalogoproductos/' . $nombreImagen;
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
            'id' => 'required|exists:productos,id',
        ]);

        $producto = Producto::findOrFail($request->id);

        $producto->activo = 0;

        $producto->save();

        return redirect()
            ->back()
            ->with(
                'success',
                'Producto dado de baja correctamente'
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

public function actualizarProducto(
    ProductoRequest $request,
    $id
) {
    $this->verificarAdmin();

    $producto = Producto::findOrFail($id);

    $datos = $request->validated();

    if ($request->hasFile('url_imagen')) {

        $imagen = $request->file('url_imagen');

        $nombreImagen =
            time().'_'.$imagen->getClientOriginalName();

        $imagen->move(
            public_path('img/catalogoproductos'),
            $nombreImagen
        );

        $datos['url_imagen'] =
            'img/catalogoproductos/'.$nombreImagen;
    }

    $producto->update($datos);

    return redirect('/admin/productos')
        ->with(
            'success_message',
            'Producto actualizado correctamente.'
        );
}
}