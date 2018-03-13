<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class OperacaoFavoritaRequest extends Request
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
            'id_usuario' => 'required',
            'id_sistema' => 'required',
            'id_operacao' => 'required',
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
            'id_usuario.required' => 'O campo "Usuário" é obrigatório.',
            'id_sistema.required' => 'O Campo "Sistema" é obrigatório.',            
            'id_operacao.required' => 'O Campo "Operação" é obrigatório.', 
        ];
    }
}
