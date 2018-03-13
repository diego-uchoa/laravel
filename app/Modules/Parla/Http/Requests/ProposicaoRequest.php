<?php
namespace App\Modules\Parla\Http\Requests;

use App\Http\Requests\Request;

class ProposicaoRequest extends Request {

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
	        'sg_tipo' => 'required',
	        'nr_numero' => 'required|integer',
	        'an_ano' => 'required|integer|digits_between:4,4',
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
	        'sg_tipo.required' => 'O campo "Tipo" é obrigatório.',
	        'nr_numero.required' => 'O campo "Número" é obrigatório.',
	        'nr_numero.integer' => 'O campo "Número" deve conter apenas números.',
	        'an_ano.required' => 'O campo "Ano" é obrigatório.',
	        'an_ano.integer' => 'O campo "Ano" deve conter apenas números.',
	        'an_ano.digits_between' => 'O campo "Ano" deve conter quatro dígitos.',
	    ];
	}
}