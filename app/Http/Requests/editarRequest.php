<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editarRequest extends FormRequest
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
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|unique:productos|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|integer',
            'cantidad' => 'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return[
            'nombre.required'=>'El nombre es obligatorio',
            'nombre.unique'=>'El nombre debe ser unico',
            'imagen.required'=> 'La imagen es requerida',
            'precio.required'=>'El producto necesita un precio obligatoriamente',
            'categoria.required'=>'La categoria es obligatoria',
            'cantidad.required'=>'¿Cuantos productos son?',
            'cantidad.min' => 'La cantidad no puede ser menor a 0',
        ];
    }
}
