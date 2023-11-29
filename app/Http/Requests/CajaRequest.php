<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaRequest extends FormRequest
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
            'fecha_apertura' => 'required','date',
            'monto_inicial' => 'required',
            'fecha_cierre' => 'nullable',
            'monto_final' => 'nullable',
            'cantidad_ventas' => 'nullable|string|max:20',
            'status' => 'required',    
        ];
    }
    
    public function messages()
    {
        return[
            'fecha_apertura.required'=>'La fecha es obligatoria.',
            'monto_inicial.required'=>'El monto inicial debe ser registrado.',
            'fecha_cierre.nullable',
            'monto_final.nullable',
            'cantidad_ventas.nullable',
            'status.required',
        ];
    }
}
