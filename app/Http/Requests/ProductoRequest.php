<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->route('id') ? true : false;

        return [
            'nombre' => 'required|string|max:150',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
            
            'url_imagen' => $isUpdate 
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048' 
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'origen' => 'nullable|string|max:100',
            'bodega' => 'nullable|string|max:100',
            'graduacion' => 'nullable|string|max:50',
            'volumen' => 'nullable|string|max:50',
            'variedad' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser numérico.',
            'stock.required' => 'El stock es obligatorio.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'url_imagen.image' => 'El archivo debe ser una imagen.',
            'url_imagen.mimes' => 'La imagen debe ser jpg, jpeg, png o webp.',
            'url_imagen.required' => 'La imagen es obligatoria.',
            'descripcion.required' => 'La descripción es obligatoria.',
        ];
    }
}