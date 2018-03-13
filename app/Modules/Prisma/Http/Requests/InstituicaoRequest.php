<?php

namespace App\Modules\Prisma\Http\Requests;

use App\Http\Requests\Request;

class InstituicaoRequest extends Request
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
            'no_relatorio'   =>  'required|max:100|unique:pgsql.spoa_portal_prisma_s1.instituicao',
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
            'no_relatorio.required' => 'O campo "Nome em relatórios" é obrigatório.',
            'no_relatorio.max' => 'O campo "Nome" não deve ser maior que 100 caracteres.',
            'no_relatorio.unique' => 'Já existe uma instituição cadastrada com esse nome.'
        ];
    }
}
