<?php

namespace App\Modules\Sisfone\Http\Requests;

use App\Http\Requests\Request;

class TelefoneRequest extends Request
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
            'tx_telefone' => 'required|max:20',
            'id_tipo_telefone' => 'required',
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
            'tx_telefone.required' => 'O campo "Número de Telefone" é obrigatório.',
            'tx_telefone.max' => 'O campo "Número de Telefone" não deve ser maior que 20 caracteres.',
            'id_tipo_telefone.required' => 'O Campo "Tipo" é obrigatório.',            
        ];
    }
}
