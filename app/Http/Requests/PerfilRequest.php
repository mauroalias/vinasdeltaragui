<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PerfilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',

            'direccion' => 'required|string|max:255|min:5',

            'telefono' => 'required|string|min:6|max:20', 
        ];
    }

    public function messages(): array
    {
        return [
            'direccion.required' => 'La dirección es obligatoria para poder realizar envíos.',
            'direccion.min' => 'Por favor, ingresa una dirección válida y completa.',
            
            'telefono.required' => 'El número de teléfono es obligatorio.',
            'telefono.min' => 'El teléfono debe tener un formato válido (mínimo 6 dígitos).',
        ];
    }
}