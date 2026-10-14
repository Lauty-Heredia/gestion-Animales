<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class AnimalDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function PrepareforValidation(): void
    {
        if ($this->has('nombre')){
            $this->merge([
                'nombre' => Str::ucfirst(Str::lower(trim($this->input('nombre')))),
            ]);
        }

        if ($this->has('especie')){
            $this->merge([
                'especie' => Str::ucfirst(Str::lower(trim($this->input('especie')))),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255|in:Perro,Gato,Conejo,Pez,Ave',
            'edad' => 'required|integer|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'especie.required' => 'La especie es obligatoria.',
            'especie.string' => 'La especie debe ser una cadena de texto.',
            'especie.max' => 'La especie no puede tener más de 255 caracteres.',
            'especie.in' => 'La especie debe ser uno de los siguientes valores: Perro, Gato, Conejo, Pez, Ave.',
            'edad.required' => 'La edad es obligatoria.',
            'edad.integer' => 'La edad debe ser un número entero.',
            'edad.min' => 'La edad no puede ser negativa.',
            'edad.max' => 'La edad no puede ser mayor a 100 años.',
        ];
    }
}
