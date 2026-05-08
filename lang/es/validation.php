<?php

return [
    'accepted'        => 'El campo :attribute debe ser aceptado.',
    'active_url'      => 'El campo :attribute no es una URL válida.',
    'after'           => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'           => 'El campo :attribute solo puede contener letras.',
    'boolean'         => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'       => 'La confirmación de :attribute no coincide.',
    'date'            => 'El campo :attribute no es una fecha válida.',
    'decimal'         => 'El campo :attribute debe tener :decimal decimales.',
    'email'           => 'El campo :attribute debe ser una dirección de correo válida.',
    'integer'         => 'El campo :attribute debe ser un número entero.',
    'max'             => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'string'  => 'El campo :attribute no debe ser mayor a :max caracteres.',
    ],
    'numeric'         => 'El campo :attribute debe ser un número.',
    'required'        => 'El campo :attribute es obligatorio.',
    'string'          => 'El campo :attribute debe ser una cadena de caracteres.',
    'unique'          => 'El campo :attribute ya ha sido registrado.',
    'url'             => 'El campo :attribute debe ser una URL válida.',

    /*
    |--------------------------------------------------------------------------
    | Nombres de los campos (Atributos)
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        // Campos de Contacto
        'nombre'      => 'nombre completo',
        'email'       => 'correo electrónico',
        'motivo'      => 'motivo de consulta',
        'consulta'    => 'mensaje',
        
        // Campos de Productos
        'descripcion' => 'descripción del producto',
        'precio'      => 'precio unitario',
        'stock'       => 'stock disponible',
        'url_imagen'  => 'imagen del producto',
        'activo'      => 'estado de visibilidad',
    ],
];