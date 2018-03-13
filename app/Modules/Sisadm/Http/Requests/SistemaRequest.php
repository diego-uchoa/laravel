<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class SistemaRequest extends Request
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
            'no_sistema' => 'required|max:100',
            'ds_sistema' => 'required|max:255',
            'co_esquema' => 'required|max:50',
        ];
    }

    /**
     * Tratando as mensagens de valiação do formulário
     *
     * @return array
    */
    public function messages()
    {
        return [
            'no_sistema.required' => 'O campo "Nome" é obrigatório.',
            'no_sistema.max' => 'O campo "Nome" não deve ser maior que 100 caracteres.',
            'ds_sistema.required' => 'O campo "Descrição" é obrigatório.',
            'ds_sistema.max' => 'O campo "Descrição" não deve ser maior que 255 caracteres.',
            'co_esquema.required' => 'O campo "Código Esquema" é obrigatório.',
            'co_esquema.max' => 'O campo "Código Esquema" não deve ser maior que 255 caracteres.',
        ];
    }
}
