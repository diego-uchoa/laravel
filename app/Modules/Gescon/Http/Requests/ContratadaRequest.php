<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class ContratadaRequest extends Request
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
            'nr_cpf_cnpj' => 'required|composite_unique:spoa_portal_gescon.contratada,nr_cpf_cnpj,id_contratada:pk',
            'no_razao_social' => 'required|max:200',
            'ed_logradouro' => 'required|max:255',
            'id_municipio_logradouro' => 'required',
            'no_representante' => 'required|max:200',
            'nr_telefone' => 'required',
            'ds_email' => 'max:100|email'
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
            'nr_cpf_cnpj.required' => 'O campo "CPF/CNPJ" é obrigatório.',
            'nr_cpf_cnpj.composite_unique' => 'Já existe um registro cadastrado com este "CPF/CNPJ".',
            'no_razao_social.required' => 'O campo "Razão Social" é obrigatório.',
            'no_razao_social.max' => 'O campo "Razão Social" não deve ser maior que 200 caracteres.',
            'ed_logradouro.required' => 'O campo "Logradouro" é obrigatório.',
            'ed_logradouro.max' => 'O campo "Logradouro" não deve ser maior que 255 caracteres.',
            'id_municipio_logradouro.required' => 'O campo "Municipio" é obrigatório.',
            'no_representante.required' => 'O campo "Representante" é obrigatório.',
            'no_representante.max' => 'O campo "Representante" não deve ser maior que 200 caracteres.',
            'nr_telefone.required' => 'O campo "Telefone" é obrigatório.',
            'ds_email.max' => 'O campo "Email" não deve ser maior que 100 caracteres.',
            'ds_email.email' => 'O Email informado não é válido.'
        ];
    }
}
