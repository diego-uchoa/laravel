<?php

namespace App\Modules\Prisma\Http\Requests;

use App\Http\Requests\Request;

class RejeitarSolicitacaoCadastroRequest extends Request
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
            'tx_analise'   =>  'required'
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
            'tx_analise.required' => 'O campo "Análise de Solicitação de Cadastro" é obrigatório.',
        ];
    }
}
