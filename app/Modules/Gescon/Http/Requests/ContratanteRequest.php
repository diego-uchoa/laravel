<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class ContratanteRequest extends Request
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
            'id_orgao' => 'required|unique:pgsql.spoa_portal_gescon.contratante,id_orgao,null,id,deleted_at,NULL',
            'nr_cpf_representante' => 'required|cpf',
            'no_representante' => 'required|max:255',
            'nr_rg_representante' => 'required|numeric',
            'ds_funcao_representante' => 'required|max:100',
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
            'id_orgao.required' => 'O campo "UASG" é obrigatório.',
            'id_orgao.unique' => 'Contratante (UASG) já cadastrada.',
            'nr_cpf_representante.required' => 'O campo "CPF" é obrigatório.',
            'nr_cpf_representante.cpf' => 'O CPF informado não é válido.',
            'no_representante.required' => 'O campo "Nome" é obrigatório.',
            'no_representante.max' => 'O campo "Nome" não deve ser maior que 255 caracteres.',
            'nr_rg_representante.required' => 'O campo "RG" é obrigatório.',
            'nr_rg_representante.numeric' => 'O "RG" informado não é válido.',
            'ds_funcao_representante.required' => 'O campo "Cargo" é obrigatório.',
            'ds_funcao_representante.max' => 'O campo "Cargo" não deve ser maior que 100 caracteres.',
            'dt_inicio.required' => 'O campo "Data Início" é obrigatório.',
        ];
    }
}
