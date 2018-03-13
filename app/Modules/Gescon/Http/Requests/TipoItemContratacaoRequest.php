<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class TipoItemContratacaoRequest extends Request
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
            'in_objeto' => 'required',
            'ds_tipo_item_contratacao' => 'required'
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
            'in_objeto.required' => 'O campo "Objeto" é obrigatório.',
            'ds_tipo_item_contratacao.required' => 'O campo "Descrição" é obrigatório.'
        ];
    }
}
