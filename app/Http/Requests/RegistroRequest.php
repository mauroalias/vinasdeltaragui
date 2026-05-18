<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'nombre' => 'required|string|max:100',

            'correo' => 'required|email|unique:users,email',

            'fecha_nacimiento' => 'required|date',

            'password' => 'required|min:8|confirmed',

        ];
    }

    public function messages(): array
    {
        return [

            'nombre.required' => 'El nombre es obligatorio.',

            'correo.required' => 'El correo es obligatorio.',

            'correo.email' => 'Ingresá un email válido.',

            'correo.unique' => 'Ese correo ya está registrado.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',

            'password.required' => 'La contraseña es obligatoria.',

            'password.min' => 'La contraseña debe tener mínimo 8 caracteres.',

            'password.confirmed' => 'Las contraseñas no coinciden.',

        ];
    }
}