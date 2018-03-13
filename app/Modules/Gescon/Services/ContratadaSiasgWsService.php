<?php
namespace App\Modules\Gescon\Services;

use Illuminate\Support\Collection;
use Exception;
use Carbon\Carbon;

class ContratadaSiasgWsService extends SiasgWsService
{
	const COMPLEMENTO_WSDL = 'fornecedores';

	/**
	* Recuperar os dados da função passada por parametros
	* @param  string $funcao
	* @param  array $parametros
	* @return string
	*/
	private function _obterDados($funcao, $parametros)
	{
		try{

			return simplexml_load_string(parent::getClient($funcao, self::COMPLEMENTO_WSDL, $parametros));

	    }catch(Exception $e){

	        throw new Exception('Erro: Não foi possível encontrar a contratada.', 999);

	    }

	}

	/**
	* Recuperar dados da contratada no WS através do CNPJ
	* @param string cnpj
	* @return Contratada
	*/
	public function findContratadaByCnpj($cnpj)
	{
		$parametros = [];
		$funcao = 'doc/fornecedor_pj/'. $cnpj . '.xml';
		
		try{
		
			$fornecedorWS = $this->_obterDados($funcao, $parametros);
			return $fornecedorWS;

		}catch (Exception $e){

			return "";

		}
		
	}

}