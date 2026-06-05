<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosFacturacion extends Model
{
    protected $table = 'datos_facturacion';

    protected $fillable = [
        'user_id',
        'direccion',
        'telefono'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}