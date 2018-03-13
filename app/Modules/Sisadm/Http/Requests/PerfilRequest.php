<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class PerfilRequest extends Request
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
            'no_perfil' => 'required|max:100',
            'ds_perfil' => 'required|max:255',
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
            'no_perfil.required' => 'O campo "Nome" é obrigatório.',
            'no_perfil.max' => 'O campo "Nome" não deve ser maior que 100 caracteres.',
            'ds_perfil.required' => 'O Campo "Descrição" é obrigatório.',
            'ds_perfil.max' => 'O campo "Descrição" não deve ser maior que 255 caracteres.',
        ];
    }
}
