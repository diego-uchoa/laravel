<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class ContratoRequest extends Request
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
            'nr_contrato' => 'required',
            'co_uasg' => 'required',
            'id_contratante' => 'required',
            'id_contratante_representante' => 'required',
            'in_tipo' => 'required',
            'nr_modalidade' => 'required',
            'id_modalidade' => 'required',
            'nr_processo' => 'required',
            'in_tipo_contratada' => 'required',
            'nr_cpf_cnpj' => 'required|composite_unique:spoa_portal_gescon.contratada,nr_cpf_cnpj,id_contratada:pk',
            'no_razao_social' => 'required|max:200',
            'ed_cep_logradouro' => 'required',
            'ed_logradouro' => 'required|max:255',
            'id_municipio_logradouro' => 'required',
            'no_representante' => 'required|max:200',
            'nr_telefone' => 'required',
            'ds_email' => 'required|max:100|email',
            'ds_objeto' => 'required|max:255',
            'ds_informacao_complementar' => 'max:500',
            'vl_mensal' => 'required',
            'vl_anual' => 'required',
            'vl_global' => 'required',
            'dt_assinatura' => 'required',
            'dt_publicacao' => 'required',
            'dt_inicio_servico' => 'required',
            'dt_prorrogacao' => 'required',
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
            'nr_contrato.required' => 'O campo "Nº Contrato" é obrigatório.',
            'co_uasg.required' => 'O campo "UASG" é obrigatório.',
            'id_contratante.required' => 'O campo "Contratante" é obrigatório.',
            'id_contratante_representante.required' => 'O campo "Representante da Contratante" é obrigatório.',
            'in_tipo.required' => 'O campo "Tipo Contrato" é obrigatório.',
            'nr_modalidade.required' => 'O campo "Nº Modalidade" é obrigatório.',
            'id_modalidade.required' => 'O campo "Modalidade" é obrigatório.',
            'nr_processo.required' => 'O campo "Nº Processo" é obrigatório.',
            'in_tipo_contratada.required' => 'O campo "Tipo Contratada" é obrigatório.',
            'nr_cpf_cnpj.required' => 'O campo "CPF/CNPJ" é obrigatório.',
            'nr_cpf_cnpj.composite_unique' => 'Já existe um registro cadastrado com este "CPF/CNPJ".',
            'no_razao_social.required' => 'O campo "Razão Social" é obrigatório.',
            'no_razao_social.max' => 'O campo "Razão Social" não deve ser maior que 200 caracteres.',
            'ed_cep_logradouro.required' => 'O campo "CEP" é obrigatório.',
            'ed_logradouro.required' => 'O campo "Logradouro" é obrigatório.',
            'ed_logradouro.max' => 'O campo "Logradouro" não deve ser maior que 255 caracteres.',
            'id_municipio_logradouro.required' => 'O campo "Municipio" é obrigatório.',
            'no_representante.required' => 'O campo "Representante" é obrigatório.',
            'no_representante.max' => 'O campo "Representante" não deve ser maior que 200 caracteres.',
            'nr_telefone.required' => 'O campo "Telefone" é obrigatório.',
            'ds_email.required' => 'O campo "Email" é obrigatório.',
            'ds_email.max' => 'O campo "Email" não deve ser maior que 100 caracteres.',
            'ds_email.email' => 'O Email informado não é válido.',
            'ds_objeto.required' => 'O campo "Descrição do Objeto" é obrigatório.',
            'ds_objeto.max' => 'O campo "Descrição do Objeto" não deve ser maior que 255 caracteres.',
            'ds_informacao_complementar.max' => 'O campo "Informações Complementares" não deve ser maior que 500 caracteres.',
            'vl_mensal.required' => 'O campo "Valor Mensal" é obrigatório.',
            'vl_anual.required' => 'O campo "Valor Anual" é obrigatório.',
            'vl_global.required' => 'O campo "Valor Global" é obrigatório.',
            'dt_assinatura.required' => 'O campo "Assinatura" é obrigatório.',
            'dt_publicacao.required' => 'O campo "Publicação do Contrato" é obrigatório.',
            'dt_inicio_servico.required' => 'O campo "Início Prest. de Serviço" é obrigatório.',
            'dt_prorrogacao.required' => 'O campo "Prorrogação" é obrigatório.',
        ];
    }
}
