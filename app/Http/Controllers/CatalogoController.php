<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class CatalogoController extends Controller
{
    public function catalogocompleto()
    {
        $productos = Categoria::with(['productos' => function ($query) {
            $query->where('activo', true);
        }])->get();

        return view('frontend.catalogocompleto', [
            'categorias' => $productos,
        ]);
    }

    public function categoria($tipo)
    {
        $categoria = Categoria::where('slug', $tipo)
            ->with(['productos' => function ($query) {
                $query->where('activo', true);
            }])
            ->firstOrFail();

        return view('frontend.catalogo', [
            'categoria' => $categoria,
            'productos' => $categoria->productos,
            'tipo' => $categoria->slug,
        ]);
    }

    public function detalle($tipo, $id)
    {
        $categoria = Categoria::where('slug', $tipo)->firstOrFail();

        $producto = Producto::where('id', $id)
            ->where('categoria_id', $categoria->id)
            ->where('activo', true)
            ->firstOrFail();

        $relacionados = Producto::where('categoria_id', $categoria->id)
            ->where('id', '!=', $producto->id)
            ->where('activo', true)
            ->take(8)
            ->get();

        return view('frontend.detalle-producto', [
            'producto' => $producto,
            'tipo' => $categoria->slug,
            'id' => $producto->id,
            'relacionados' => $relacionados,
        ]);
    }
}