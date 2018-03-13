<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class FeriadoRequest extends Request
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
            'dt_feriado' => 'required',
            'no_feriado' => 'required',
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
            'dt_feriado.required' => 'O campo "Data" é obrigatório.',
            'no_feriado.required' => 'O Campo "Nome" é obrigatório.',            
        ];
    }
}
