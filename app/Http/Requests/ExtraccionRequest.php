<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExtraccionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'monto' => 'required|numeric|min:5|max:100000', // Monto no debe ser negativo, mínimo $5, máximo $100,000
            'razon' => 'required|string|max:80', // Razón no debe exceder 80 caracteres
            
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'monto.required' => 'El monto es obligatorio.',
            'monto.numeric' => 'El monto debe ser un número.',
            'monto.min' => 'El monto no puede ser negativo y debe ser de al menos $5.',
            'monto.max' => 'El monto no puede superar los $100,000.',
            'razon.required' => 'La razón es obligatoria.',
            'razon.string' => 'La razón debe ser un texto.',
            'razon.max' => 'La razón no puede exceder los 80 caracteres.',
            
        ];
    }
}
