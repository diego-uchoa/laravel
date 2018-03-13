<?php

namespace App\Modules\Prisma\Http\Requests;

use App\Http\Requests\Request;

class InstituicaoResponsavelPrevisaoRequest extends Request
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
            'no_instituicao_responsavel_previsao'   =>  'required|max:100|unique:pgsql.spoa_portal_prisma_s1.instituicao_responsavel_previsao'
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
            'no_instituicao_responsavel_previsao.required' => 'O campo "Nome" é obrigatório.',
            'no_instituicao_responsavel_previsao.max' => 'O campo "Nome" não deve ser maior que 100 caracteres.',
            'no_instituicao_responsavel_previsao.unique' => 'Já existe uma instituição cadastrada com esse nome.'
        ];
    }
}
