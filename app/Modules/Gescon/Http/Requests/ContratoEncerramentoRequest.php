<?php

namespace App\Modules\Gescon\Http\Requests;

use App\Http\Requests\Request;

class ContratoEncerramentoRequest extends Request
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
            'dt_encerramento' => 'required',
            'ds_justificativa' => 'required|max:255'
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
            'dt_encerramento.required' => 'O campo "Data de Encerramento" é obrigatório.',
            'ds_justificativa.required' => 'O campo "Justificativa" é obrigatório.',
            'ds_justificativa.max' => 'O campo "Justificativa" não deve ser maior que 255 caracteres.',
        ];
    }
}
