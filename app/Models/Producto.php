<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'url_imagen',
        'origen',
        'bodega',
        'graduacion',
        'volumen',
        'variedad',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'activo' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}