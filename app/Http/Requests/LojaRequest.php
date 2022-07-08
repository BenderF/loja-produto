<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LojaRequest extends FormRequest
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
            'nome_loja' => 'required|min:3|max:40|string',
            'email' => 'required|unique:loja|email'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome_loja.required' => 'Por favor, coloque um nome para a loja',
            'nome_loja.min' => 'O número minimo de caracteres é 3',
            'nome_loja.max' => 'O número maximo de caracteres é 40',
            'nome_loja.string' => 'O nome da loja precisa ser uma string',

            'email.required' => 'Por favor, coloque um email',
            'email.unique' => 'Por favor, coloque um email unico',
            'email.email' => 'Por favor, coloque um email valido',
        ];
    }
}
