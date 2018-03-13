<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class ContratanteUsuarioRequest extends Request
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
            'id_usuario.required' => 'Os campos "Cpf", "Nome", "Email" e "Órgão" são obrigatórios.',
        ];
    }
}
