<?php

namespace App\Http\Controllers;

class CatalogoController extends Controller
{
    public function categoria($tipo)
    {
        $productos = $this->obtenerProductos();

        if (!array_key_exists($tipo, $productos)) {
            abort(404);
        }

        return view('frontend.catalogo', [
            'productos' => $productos[$tipo],
            'tipo' => $tipo
        ]);
    }

    public function obtenerProductos()
    {
        return [
            'vinos' => [
                ['nombre' => 'Obeja Black Reserva', 'descripcion' => 'Notas a frutos rojos', 'precio' => 15000, 'stock' => 8, 'imagen' => 'catalogoproductos/vino1.png'],
                ['nombre' => 'Decoy Sonoma', 'descripcion' => 'Intenso y elegante', 'precio' => 60000, 'stock' => 5, 'imagen' => 'catalogoproductos/vino2.png'],
                ['nombre' => 'Penfolds Bin 600 California', 'descripcion' => 'Suave y equilibrado', 'precio' => 150000, 'stock' => 0, 'imagen' => 'catalogoproductos/vino3.png'],
                ['nombre' => 'El Enemigo', 'descripcion' => 'Aromas especiados', 'precio' => 21000, 'stock' => 6, 'imagen' => 'catalogoproductos/vino4.png'],
                ['nombre' => 'Angélica Zapata', 'descripcion' => 'Selección especial', 'precio' => 29500, 'stock' => 3, 'imagen' => 'catalogoproductos/vino5.png'],
            ],

            'whiskys' => [
                ['nombre' => 'Jack Daniels', 'descripcion' => 'Whisky americano clásico', 'precio' => 25000, 'stock' => 7, 'imagen' => 'catalogoproductos/whisky1.png'],
                ['nombre' => 'Johnnie Walker Black Label', 'descripcion' => 'Intenso y elegante', 'precio' => 35000, 'stock' => 4, 'imagen' => 'catalogoproductos/whisky2.png'],
                ['nombre' => 'Johnnie Walker Blue Label', 'descripcion' => 'Premium escocés', 'precio' => 300000, 'stock' => 2, 'imagen' => 'catalogoproductos/whisky3.png'],
                ['nombre' => 'Chivas Regal', 'descripcion' => 'Suave y distinguido', 'precio' => 35000, 'stock' => 0, 'imagen' => 'catalogoproductos/whisky4.png'],
                ['nombre' => 'Jameson', 'descripcion' => 'Irlandés equilibrado', 'precio' => 30000, 'stock' => 9, 'imagen' => 'catalogoproductos/whisky5.png'],
            ],

            'otros' => [
                ['nombre' => 'Athos Gin 500', 'descripcion' => 'Ideal para cocktails', 'precio' => 12000, 'stock' => 6, 'imagen' => 'catalogoproductos/otros1.png'],
                ['nombre' => 'Vodka', 'descripcion' => 'Suave y versátil', 'precio' => 10000, 'stock' => 8, 'imagen' => 'catalogoproductos/otros2.png'],
                ['nombre' => 'Ron Barceló', 'descripcion' => 'Notas dulces', 'precio' => 18000, 'stock' => 4, 'imagen' => 'catalogoproductos/otros3.png'],
                ['nombre' => 'Tequila 1800', 'descripcion' => 'Intenso y auténtico', 'precio' => 40000, 'stock' => 0, 'imagen' => 'catalogoproductos/otros4.png'],
                ['nombre' => 'Vermouth Rosso', 'descripcion' => 'Perfecto para compartir', 'precio' => 15300, 'stock' => 5, 'imagen' => 'catalogoproductos/otros5.png'],
            ],
        ];
    }
}