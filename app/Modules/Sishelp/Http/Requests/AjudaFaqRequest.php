<?php

namespace App\Modules\Sishelp\Http\Requests;

use App\Http\Requests\Request;

class AjudaFaqRequest extends Request
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
            'tx_pergunta' => 'required|max:500',
            'tx_resposta' => 'required|max:500',
            'id_sistema' => 'required',
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
            'tx_pergunta.required' => 'O campo "Pergunta" é obrigatório.',
            'tx_pergunta.max' => 'O campo "Pergunta" não deve ser maior que 500 caracteres.',
            'tx_resposta.required' => 'O campo "Resposta" é obrigatório.',
            'tx_resposta.max' => 'O campo "Resposta" não deve ser maior que 500 caracteres.',            
            'id_sistema.required' => 'O Campo "Sistema" é obrigatório.',            
        ];
    }
}
