<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class UsuarioRequest extends Request
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
            'no_usuario' => 'required|max:255',
            'email' => 'required|email|max:255',
            'id_orgao' => 'required',
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
            'no_usuario.required' => 'O campo "Nome" é obrigatório.',
            'no_usuario.max' => 'O campo "Nome" não deve ser maior que 255 caracteres.',
            'email.required' => 'O campo "Email" é obrigatório.',
            'email.max' => 'O campo "CPF" não deve ser maior que 11 caracteres.',
            'email.email' => 'O email informado não é válido.',
            'id_orgao.required' => 'O campo "Órgão" é obrigatório.',
        ];
    }
}
