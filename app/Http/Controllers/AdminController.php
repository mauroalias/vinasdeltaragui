<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\User;
use Illuminate\Http\Request;

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
            'totalProductos' => Producto::where('activo', 1)->count(),
            'totalContactos' => Contacto::count(),
        ]);
    }

    public function productos()
    {
        $this->verificarAdmin();

        return view('backend.admin.productos', [
            'productos' => Producto::with('categoria')
                ->where('activo', 1)
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

    public function guardarProducto(Request $request)
    {
        $this->verificarAdmin();

        $datos = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'url_imagen' => 'nullable|string|max:255',
            'origen' => 'nullable|string|max:150',
            'bodega' => 'nullable|string|max:150',
            'graduacion' => 'nullable|string|max:50',
            'volumen' => 'nullable|string|max:50',
            'variedad' => 'nullable|string|max:150',
        ]);

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
}