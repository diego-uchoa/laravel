<?php
namespace App\Modules\Prisma\Services;

use Illuminate\Support\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CnpjWsService
{
	private $wsdl;
	
	public function __construct() {
		$this->_configuraWS();
	}

	/**
	* Responsável por configurar os dados de acesso ao WS
	* @param  string $complementoWSDL
	*/
	private function _configuraWS() {
		$this->wsdl = env('CNPJ_WSDL');
	}

	/**
	* Responsável por acessar o WebService e realizar a chamada da Função
	* @param  string $função
	* @param  string $complementoWSDL
	* @param  array $parametros
	* @return mixed
	*/
	private function _getClient($funcao, $parametros) {
		try {
			$client = new Client(['base_uri' => $this->wsdl]);
			$listaParametros = $this->_preparaParametros($parametros);
			$response = $client->request('GET', $funcao . '?' . $listaParametros);

			return json_decode($response->getBody()->getContents());
	    } catch(RequestException $e) {
	    	return array('status' => 'error', 'msg' => $e->getMessage());
	    }
	}

	/**
	* Recuperar os dados da função passada por parametros
	* @param  string $funcao
	* @param  array $parametros
	* @return string
	*/
	private function _obterDados($funcao, $parametros) {
		try {
			return $this->_getClient($funcao, $parametros);
	    } catch(Exception $e) {
	        return null;
	    }
	}

	/**
	* Responsável por transformar o array de Parametros em uma string
	* @param  array $arrayParametros
	* @return string
	*/
	private function _preparaParametros($arrayParametros)
	{
		$listaParametros = '';
		if (sizeof($arrayParametros) > 0)
		{
			$arrayKeys = array_keys($arrayParametros);
			$ultimaKey = end($arrayKeys);
			foreach ($arrayParametros as $key => $value) {
				$listaParametros .= $key . '=' . $value;
				if ($ultimaKey != $key)
				{
					$listaParametros .= '&';
				}
			}
		}
		return $listaParametros;
	}

	/**
	* Recuperar dados da instituição a partir do CNPJ
	* @return 
	*/
	public function findByCnpj($cnpj) {
		return $this->_obterDados($cnpj, array());
	}

}