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
            'nombre.max' => 'El nombre no puede superar los 150 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser de al menos $1.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser menor a 0.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'url_imagen.required' => 'La imagen es obligatoria.',
            'url_imagen.image' => 'El archivo debe ser una imagen.',
            'url_imagen.mimes' => 'La imagen debe estar en formato: jpg, jpeg, png o webp.',
            'url_imagen.max' => 'La imagen no puede pesar más de 2 MB.',
            'url_imagen.uploaded' => 'La imagen no puede pesar más de 2 MB o el formato no es válido.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede superar los 1000 caracteres.',
            'origen.max' => 'El origen no puede superar los 100 caracteres.',
            'bodega.max' => 'La bodega no puede superar los 100 caracteres.',
            'graduacion.max' => 'La graduación no puede superar los 50 caracteres.',
            'volumen.max' => 'El volumen no puede superar los 50 caracteres.',
            'variedad.max' => 'La variedad no puede superar los 100 caracteres.',
        ];
    }
}