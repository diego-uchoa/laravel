<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class AvisoSistemaRequest extends Request
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
            'tx_aviso_sistema' => 'required|max:100',
            'id_tipo_aviso_sistema' => 'required',
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
            'tx_aviso_sistema.required' => 'O campo "Texto" é obrigatório.',
            'tx_aviso_sistema.max' => 'O campo "Text" não deve ser maior que 100 caracteres.',
            'id_tipo_aviso_sistema.required' => 'O Campo "Tipo" é obrigatório.',            
        ];
    }
}
