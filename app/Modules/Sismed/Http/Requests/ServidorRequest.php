<?php

namespace App\Modules\Sismed\Http\Requests;

//use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class ServidorRequest extends Request
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
            'nr_cpf' => 'uniquecpfservidor:nr_cpf|required',
            'no_servidor' => 'required',
            'ds_email' => 'required',
            'tx_telefone_celular' => 'required'
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
            'uniquecpfservidor' => 'Servidor já cadastrado.',
            'nr_cpf.required' => 'O campo CPF é obrigatório.',
            'no_servidor.required' => 'O campo Nome é obrigatório.',
            'ds_email.required' => 'O campo Email é obrigatório',
            'tx_telefone_celular.required' => 'O campo Telefone Celular é obrigatório'
        ];
    }
}
