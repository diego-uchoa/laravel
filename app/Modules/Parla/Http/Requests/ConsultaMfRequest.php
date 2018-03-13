<?php

namespace App\Modules\Parla\Http\Requests;

use App\Http\Requests\Request;

class ConsultaMfRequest extends Request
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
            'id_proposicao' => 'required',
            'id_orgao' => 'required',
            'id_tipo_consulta' => 'required',
            'dt_envio' => 'required',
            'nr_prioritario' => 'required',
            'id_tipo_posicao' => 'required_with:dt_retorno',
            'dt_retorno' => 'required_with:id_tipo_posicao',
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
            'id_proposicao.required' => 'O campo "Proposição" é obrigatório.',
            'id_orgao.required' => 'O campo "Órgão" é obrigatório.',
            'id_tipo_consulta.required' => 'O campo "Tipo da consulta" é obrigatório.',
            'dt_envio.required' => 'O campo "Data de envio" é obrigatório.',
            'nr_prio.required' => 'O campo "Prioridade" é obrigatório.',
            'id_tipo_posicao.required_with' => 'O campo "Tipo de posição" é obrigatório quando "Data de retorno" estiver preenchido.',
            'dt_retorno.required_with' => 'O campo "Data de retorno" é obrigatório quando "Tipo de posição" estiver preenchido.',
        ];
    }
}
