<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class RelatorioComparativoRequest extends Request
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
            'tp_contrato' => 'required'
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
            'tp_contrato.required' => 'O campo "Tipo de Contrato" é obrigatório.',
        ];
    }
}
