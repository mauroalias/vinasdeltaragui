<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|max:150',
            'motivo' => 'required|string|max:200',
            'consulta' => 'required|string|max:1000',
        ];
    }

    public function messages()
{
    return [

        'nombre.required' => 'El nombre es obligatorio.',

        'correo.required' => 'El correo es obligatorio.',
        'correo.email' => 'Ingresá un correo válido.',

        'motivo.required' => 'El motivo es obligatorio.',

        'consulta.required' => 'La consulta no puede estar vacía.',

    ];
}
}
