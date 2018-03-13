<?php

namespace App\Modules\Sishelp\Http\Requests;

use App\Http\Requests\Request;

class AjudaArquivoRequest extends Request
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
            'id_sistema' => 'required',
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
            'id_sistema.required' => 'O Campo "Sistema" é obrigatório.',            
        ];
    }
}
