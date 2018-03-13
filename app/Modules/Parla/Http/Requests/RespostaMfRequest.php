<?php

namespace App\Modules\Parla\Http\Requests;

use App\Http\Requests\Request;

class RespostaMfRequest extends Request
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
            'dt_envio' => 'required',
            'id_tipo_posicao' => 'required',
            'id_orgao' => 'required',
            'no_documento' => 'required',
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
            'dt_envio.required' => 'O campo "Data" é obrigatório.',
            'id_tipo_posicao.required' => 'O campo "Posição" é obrigatório.',
            'id_orgao.required' => 'O campo "Órgão Destino" é obrigatório.',
            'no_documento.required' => 'O campo "Documento" é obrigatório.',
        ];
    }
}
