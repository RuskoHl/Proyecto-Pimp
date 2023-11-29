<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editarProvRequest extends FormRequest
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
            'nombre' => 'required|alpha|max:255',
            'email' => 'required|email|unique:proveedors',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'cuit' => 'nullable|string|max:20',
            'comentario' => 'nullable|string',
        ];
    }
    public function messages()

{
    return  [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.alpha' => 'El nombre debe contener solo letras.',
        'nombre.max' => 'El nombre no debe exceder los :max caracteres.',

        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
        'email.unique' => 'El correo electrónico debe ser único.',

        'telefono.string' => 'El teléfono debe ser una cadena de texto.',
        'telefono.max' => 'El teléfono no debe exceder los :max caracteres.',

        'direccion.string' => 'La dirección debe ser una cadena de texto.',
        'direccion.max' => 'La dirección no debe exceder los :max caracteres.',

        'cuit.string' => 'El CUIT debe ser una cadena de texto.',
        'cuit.max' => 'El CUIT no debe exceder los :max caracteres.',

        'comentario.string' => 'El comentario debe ser una cadena de texto.',];}

    }

