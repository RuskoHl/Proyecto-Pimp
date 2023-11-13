<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class crearProveedorRequest extends FormRequest
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
            'nombre' => 'required|unique:proveedors|max:255',
            'email' => 'required|unique:proveedors',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'cuit' => 'nullable|string|max:20',
            'comentario' => 'nullable|string',    
        ];
    }
    
    public function messages()
    {
        return[
            'nombre.required'=>'El nombre es obligatorio.',
            'nombre.unique'=>'El nombre debe ser unico.',
            'email.required'=>'El email es completamente necesario.',
            'email.unique'=>'El email debe ser unico.',
            'telefono.nullable',
            'direccion.nullable',
            'cuit.nullable',
            'comentario.nullable',
        ];
    }
}