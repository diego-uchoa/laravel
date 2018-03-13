<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class ContratanteRepresentanteDevincularRequest extends Request
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
            'dt_fim' => 'required'
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
            'dt_fim.required' => 'Favor informar a data de desligamento.',
        ];
    }
}
