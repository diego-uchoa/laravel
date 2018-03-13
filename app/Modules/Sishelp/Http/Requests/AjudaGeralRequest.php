<?php

namespace App\Modules\Sishelp\Http\Requests;

use App\Http\Requests\Request;

class AjudaGeralRequest extends Request
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
            'tx_ajuda_geral' => 'required|max:50000',
            'id_sistema' => 'required|composite_unique:spoa_portal_sishelp.ajuda_geral,id_sistema,id_ajuda_geral:pk',
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
            'tx_ajuda_geral.required' => 'O campo "Visão Geral" é obrigatório.',
            'tx_ajuda_geral.max' => 'O campo "Pergunta" não deve ser maior que 50000 caracteres.',
            'id_sistema.required' => 'O Campo "Sistema" é obrigatório.', 
            'id_sistema.composite_unique' => 'O Campo "Sistema" já está cadastrado.'           
        ];
    }
}
