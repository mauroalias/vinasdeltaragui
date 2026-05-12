<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'fecha_nacimiento',
        'password',
    ];
}
