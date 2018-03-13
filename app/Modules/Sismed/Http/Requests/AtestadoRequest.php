<?php

namespace App\Modules\Sismed\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtestadoRequest extends FormRequest
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
            'te_prazo' => 'required_without_all:tx_justificativa_exclusao,destroy',
            'dt_inicio_afastamento' => 'required_without_all:tx_justificativa_exclusao,destroy',
            'dt_fim_afastamento' => 'required_without_all:tx_justificativa_exclusao,destroy',
            'tx_justificativa_exclusao' => 'Required_with_all:destroy'
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
            'datainicioatestado' => 'Cadastro não realizado. Existe atestado cadastrado com Data de Início posterior.',
            'te_prazo.required_without_all' => 'O campo Prazo é obrigatório.',
            'dt_inicio_afastamento.required_without_all' => 'O campo Início é obrigatório.',
            'dt_fim_afastamento.required_without_all' => 'O campo Fim é obrigatório.',
            'tx_justificativa_exclusao.required_with_all' => 'O campo Justificativa é obrigatório.'
        ];
    }

}
