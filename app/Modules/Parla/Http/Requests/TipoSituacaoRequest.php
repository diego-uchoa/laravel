<?php

namespace App\Modules\Parla\Http\Requests;

use App\Http\Requests\Request;

class TipoSituacaoRequest extends Request
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
            'co_tipo_situacao' => 'required|integer',
            'tx_tipo_situacao' => 'required',
            'sg_casa_situacao' => 'required|in:CD,SF',
            'sg_status_situacao' => 'required|in:S,E,T',
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
            'co_tipo_situacao.required' => 'O campo "Código na Casa" é obrigatório.',
            'co_tipo_situacao.integer' => 'O campo "Código na Casa" deve conter um número inteiro.',
            'tx_tipo_situacao.required' => 'O campo "Descrição" é obrigatório.',
            'sg_casa_situacao.required' => 'O campo "Casa" é obrigatório.',
            'sg_casa_situacao.in' => 'O campo "Casa" deve conter CD ou SF.',
            'sg_status_situacao.required' => 'O campo "Status" é obrigatório.',
            'sg_status_situacao.in' => 'O campo "Status" deve conter S, E ou T.',
        ];
    }
}
