<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class ContratanteRepresentanteRequest extends Request
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
            'nr_cpf_representante' => 'required|cpf',
            'no_representante' => 'required|max:255',
            'nr_rg_representante' => 'numeric',
            'ds_funcao_representante' => 'max:100',
            'dt_inicio' => 'required',
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
            'nr_cpf_representante.required' => 'O campo "CPF" é obrigatório.',
            'nr_cpf_representante.cpf' => 'O CPF informado não é válido.',
            'no_representante.required' => 'O campo "Nome" é obrigatório.',
            'no_representante.max' => 'O campo "Nome" não deve ser maior que 255 caracteres.',
            'nr_rg_representante.numeric' => 'O "RG" informado não é válido.',
            'ds_funcao_representante.max' => 'O campo "Cargo" não deve ser maior que 100 caracteres.',
            'dt_inicio.required' => 'O campo "Data Início" é obrigatório.',
        ];
    }
}
