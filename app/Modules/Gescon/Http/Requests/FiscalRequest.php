<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class FiscalRequest extends Request
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
            'nr_cpf' => 'required|cpf|max:14',
            'no_fiscal' => 'required|max:100',
            'nr_siape' => 'numeric|required',
            'ds_email' => 'required|max:100',
            'nr_telefone' => 'max:16'
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
            'nr_cpf.required' => 'O campo "CPF" é obrigatório.',
            'nr_cpf.cpf' => 'O CPF informado não é válido.',
            'nr_cpf.max' => 'O campo "CPF" não deve ser maior que 14 caracteres.',
            'no_fiscal.required' => 'O campo "Nome" é obrigatório.',
            'no_fiscal.max' => 'O campo "Nome" não deve ser maior que 100 caracteres.',
            'nr_siape.numeric' => 'A Matrícula SIAPE informada não é válida.',
            'nr_siape.required' => 'O campo "Matrícula SIAPE" é obrigatório.',
            'ds_email.required' => 'O campo "Email" é obrigatório.',
            'ds_email.max' => 'O campo "Email" não deve ser maior que 100 caracteres.',
            'nr_telefone.max' => 'O campo "Telefone" não deve ser maior que 16 caracteres.',
        ];
    }
}
