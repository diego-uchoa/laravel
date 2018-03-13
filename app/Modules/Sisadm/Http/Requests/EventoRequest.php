<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class EventoRequest extends Request
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
            'no_evento' => 'required|max:100',
            'ds_evento' => 'required|max:255',
            'datahora' => 'required',
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
            'no_evento.required' => 'O campo "Nome" é obrigatório.',
            'no_evento.max' => 'O campo "Nome" não deve ser maior que 100 caracteres.',
            'ds_evento.required' => 'O campo "Descrição" é obrigatório.',
            'ds_evento.max' => 'O campo "Descrição" não deve ser maior que 255 caracteres.',
            'datahora.required' => 'O campo "Data do Evento" é obrigatório.',
        ];
    }
}
