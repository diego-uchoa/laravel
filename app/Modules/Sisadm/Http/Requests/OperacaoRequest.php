<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class OperacaoRequest extends Request
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
            'no_operacao' => 'required|max:100',
            'ds_operacao' => 'required|max:255',
            'id_sistema' => 'required'
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
            'no_operacao.required' => 'O campo "Nome" é obrigatório.',
            'no_operacao.max' => 'O campo "Nome" não deve ser maior que 100 caracteres.',
            'ds_operacao.required' => 'O Campo "Descrição" é obrigatório.',
            'ds_operacao.max' => 'O campo "Descrição" não deve ser maior que 255 caracteres.',
            'id_sistema.required' => 'O Campo "Sistema" é obrigatório.',
        ];
    }
}
