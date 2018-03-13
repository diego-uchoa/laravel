<?php

namespace App\Modules\Sisadm\Http\Requests;

use App\Http\Requests\Request;

class OrgaoSistemaRequest extends Request
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
        \Validator::extend( 'composite_unique', function ( $attribute, $value, $parameters, $validator ) {
            // remove first parameter and assume it is the table name
            $table = array_shift( $parameters ); 

            // start building the conditions
            $fields = [ $attribute => $value ]; // current field, company_code in your case

            // iterates over the other parameters and build the conditions for all the required fields
            while ( $field = array_shift( $parameters ) ) {
                $fields[ $field ] = $this->get( $field );
            }

            // query the table with all the conditions
            $result = \DB::table( $table )->select( \DB::raw( 1 ) )->where( $fields )->first();

            return empty( $result ); // edited here
        }, 'your custom composite unique key validation message' );

        return [
            'id_orgao' => 'required|integer|numeric|composite_unique:spoa_portal.orgao_sistema,id_sistema',
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
            'id_orgao.required' => 'O campo "Órgão" é obrigatório.',
            'id_orgao.integer' => 'O campo "Órgão" é obrigatório.',
            'id_orgao.numeric' => 'O campo "Órgão" é obrigatório.',
            'id_orgao.composite_unique' => 'Órgão já cadastrado para esse sistema.',
            'id_sistema.required' => 'O campo "Sistema" é obrigatório.',
        ];
    }
}
