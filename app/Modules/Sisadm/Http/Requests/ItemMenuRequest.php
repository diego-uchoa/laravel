<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class ItemMenuRequest extends Request
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
            'no_item_menu' => 'required|max:100',
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
            'no_item_menu.required' => 'O campo "Nome" é obrigatório.',
            'no_item_menu.max' => 'O campo "Nome" não deve ser maior que 100 caracteres.',
        ];
    }
}
