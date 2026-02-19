<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'book_id' => 'required|exists:Books,id',
        ];
    }
    
    /**
     * Mensajes de validación personalizados
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del solicitante es obligatorio',
            'nombre.string' => 'El nombre debe ser texto',
            'libro_id.required' => 'El ID del libro es obligatorio',
            'libro_id.exists' => 'El libro no existe',
        ];
    }
}
