<?php

namespace App\Modules\Prisma\Http\Requests;

use App\Http\Requests\Request;

class AprovarSolicitacaoCadastroRequest extends Request
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
            'id_instituicao_responsavel_previsao'   =>  'required'
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
            'id_instituicao_responsavel_previsao.required' => 'O campo "Instituição Responsável pela Previsão" é obrigatório.',
        ];
    }
}
