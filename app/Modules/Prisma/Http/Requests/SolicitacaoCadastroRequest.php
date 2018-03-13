<?php

namespace App\Modules\Prisma\Http\Requests;

use App\Http\Requests\Request;

class SolicitacaoCadastroRequest extends Request
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
            'nr_cnpj'   =>  'required',
            'no_razao_social'   =>  'required',
            'no_relatorio'   =>  'required',
            'ed_cep_logradouro'   =>  'required',
            'ed_logradouro'   =>  'required',
            'ed_numero_logradouro'   =>  'required',
            'ed_bairro_logradouro'   =>  'required',
            'ed_municipio_logradouro'   =>  'required',
            'ed_sigla_uf'   =>  'required',
            'nr_cpf_responsavel'   =>  'required',
            'no_responsavel'   =>  'required',
            'ds_email_responsavel'   =>  'required',
            'no_cargo_responsavel'   =>  'required',
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
            'nr_cnpj.required' => 'O campo "CNPJ" é obrigatório.',
            'no_razao_social.required' => 'O campo "Razão Social" é obrigatório.',
            'no_relatorio.required' => 'O campo "Nome da Instituição para Relatórios" é obrigatório.',
            'ed_cep_logradouro.required' => 'O campo "CEP" é obrigatório.',
            'ed_logradouro.required' => 'O campo "Logradouro" é obrigatório.',
            'ed_numero_logradouro.required' => 'O campo "Número" é obrigatório.',
            'ed_bairro_logradouro.required' => 'O campo "Bairro" é obrigatório.',
            'ed_municipio_logradouro.required' => 'O campo "Municipio" é obrigatório.',
            'ed_sigla_uf.required' => 'O campo "UF" é obrigatório.',
            'nr_cpf_responsavel.required' => 'O campo "CPF Responsável" é obrigatório.',
            'no_responsavel.required' => 'O campo "Nome Responsável" é obrigatório.',
            'ds_email_responsavel.required' => 'O campo "E-mail Responsável" é obrigatório.',
            'no_cargo_responsavel.required' => 'O campo "Cargo Responsável" é obrigatório.',
        ];
    }
}
