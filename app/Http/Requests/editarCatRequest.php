<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editarCatRequest extends FormRequest
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
            'nombre' => 'required|unique:categorias|alpha',

        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.unique' => 'El nombre no puede ser igual a otra categoría.',
            'nombre.alpha' => 'El nombre debe contener letras. ',
           
        ];
    }
}
