<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class ContratanteAssinanteRequest extends Request
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
            'nr_cpf_assinante' => 'required|cpf',
            'no_assinante' => 'required|max:255',
            'ds_funcao_assinante' => 'required|max:100',
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
            'nr_cpf_assinante.required' => 'O campo "CPF" é obrigatório.',
            'nr_cpf_assinante.cpf' => 'O CPF informado não é válido.',
            'no_assinante.required' => 'O campo "Nome" é obrigatório.',
            'no_assinante.max' => 'O campo "Nome" não deve ser maior que 255 caracteres.',
            'ds_funcao_assinante.required' => 'O campo "Cargo" é obrigatório.',
            'ds_funcao_assinante.max' => 'O campo "Cargo" não deve ser maior que 100 caracteres.',
        ];
    }
}
