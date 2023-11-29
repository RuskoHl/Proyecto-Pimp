<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
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
            'apellido' => 'required|alpha|max:255',
            'dni' => 'required|string|max:20',
            'domicilio' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|unique:empleados',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.alpha' => 'El nombre debe contener solo letras.',
            'nombre.max' => 'El nombre no debe exceder los :max caracteres.',
            
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.alpha' => 'El apellido debe contener solo letras.',
            'apellido.max' => 'El apellido no debe exceder los :max caracteres.',
            
            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',
            'dni.max' => 'El DNI no debe exceder los :max caracteres.',
            
            'correo.email' => 'El correo debe ser una dirección de correo electrónico válida.',
            'correo.unique' => 'El correo debe ser único.',
            
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no debe exceder los :max caracteres.',
            
            'domicilio.string' => 'El domicilio debe ser una cadena de texto.',
            'domicilio.max' => 'El domicilio no debe exceder los :max caracteres.',
        ];
    }
}