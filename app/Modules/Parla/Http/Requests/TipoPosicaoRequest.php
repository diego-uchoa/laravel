<?php

namespace App\Modules\Parla\Http\Requests;

use App\Http\Requests\Request;

class TipoPosicaoRequest extends Request
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
            'tx_tipo_posicao' => 'required',
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
            'tx_tipo_posicao.required' => 'O campo "Descrição" é obrigatório.',
        ];
    }
}
