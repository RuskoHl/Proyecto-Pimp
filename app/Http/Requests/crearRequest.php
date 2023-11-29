<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class crearRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|unique:productos|max:255',
            'descripcion' => 'required|max:255',
            'precio' => 'required|numeric|max:9999999|min:5', // <zzz>
            'categoria_id' => 'required|integer',
            'cantidad' => 'required|numeric|min:0',
            'cantidad_minima' => 'required|numeric|min:1|max:9999',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.unique' => 'Ya existe un producto con este nombre. Por favor, elige otro.',
            'imagen.required' => 'La imagen del producto es requerida.',
            'precio.required' => 'El producto necesita un precio obligatoriamente.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.max' => 'El precio no puede exceder los millones.',
            'precio.min' => 'El precio no puede ser menor a 5.',
            'categoria_id.required' => 'La categoría del producto es obligatoria.',
            'categoria_id.integer' => 'La categoría debe ser un valor entero.',
            'cantidad.required' => '¿Cuántos productos son? Este campo es obligatorio.',
            'cantidad_minima.required' => '¿Cuántos productos minimos? Este campo es obligatorio.',
            'cantidad.numeric' => 'La cantidad debe ser un valor numérico.',
            'cantidad.min' => 'La cantidad no puede ser menor a 0.',
            'cantidad_minima.min' => 'La cantidad minima no puede ser 0.',
            'cantidad_minima.max' => 'La cantidad minima no puede contener 4 cifras.',
        ];
    }
}
