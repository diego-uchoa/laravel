<?php

namespace App\Modules\Parla\Http\Requests;

use App\Http\Requests\Request;

class TipoProposicaoRequest extends Request
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
            'sg_tipo_proposicao' => 'required',
            'tx_tipo_proposicao' => 'required',
            'sg_casa_origem' => 'required|in:CD,SF',
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
            'sg_tipo_proposicao.required' => 'O campo "Sigla" é obrigatório.',
            'tx_tipo_proposicao.required' => 'O campo "Descrição" é obrigatório.',
            'sg_casa_origem.required' => 'O campo "Casa (Origem)" é obrigatório.',
            'sg_casa_origem.in' => 'O campo "Casa (Origem)" deve conter CD ou SF.',
        ];
    }
}
