<?php

namespace App\Http\Requests\Vendedor;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => [
                'required',
                'max:50',
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:vendedores,email',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome' => [
                'required' => 'Campo "Nome" obrigatório.',
                'max' => 'Campo "Nome" permite até 50 caracteres.',
            ],
            'email' => [
                'required' => 'Campo "E-mail" obrigatório',
                'email' => 'Campo "E-mail" deve ser válido.',
                'max' => 'Campo "E-mail" permite até 50 caracteres.',
                'unique' => 'Já existe um vendedor com o e-mail informado.'
            ],
        ];
    }
}
