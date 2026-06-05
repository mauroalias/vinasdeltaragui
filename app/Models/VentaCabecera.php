<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaCabecera extends Model
{
    protected $table = 'ventas_cabecera';

    protected $fillable = [
    'user_id', 
    'estado', 
    'total', 
    'fecha_venta',
    'tipo_entrega',       
    'direccion_envio',    
    'telefono_contacto',  
    'costo_envio'         
];

    protected $casts = ['fecha_venta' => 'datetime'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }

    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class, 'venta_id');
    }
}