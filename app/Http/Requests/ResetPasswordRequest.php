<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResetPasswordRequest extends Request
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
            'nr_cpf' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
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
            'password.required' => 'O campo "Senha" é obrigatório.',
            'password.confirmed' => 'Os valores das senhas estão diferentes.',
            'password_confirmation.required' => 'O Campo "Confirmação Senha" é obrigatório.',            
        ];
    }
}
