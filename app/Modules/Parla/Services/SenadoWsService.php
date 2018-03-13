<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use GuzzleHttp\Client;
use Exception;

class SenadoWsService
{
	private $wsdl;
	
	public function __construct()
	{
		$this->_configuraWS();
	}

	/**
	* Responsável por configurar os dados de acesso ao WS
	* @param  string $complementoWSDL
	*/
	private function _configuraWS(){
		$this->wsdl = env('SENADO_WSDL');
	}

	/**
	* Responsável por acessar o WebService e realizar a chamada da Função
	* @param  string $função
	* @param  string $complementoWSDL
	* @param  array $parametros
	* @return mixed
	*/
	protected function getClient($funcao, $complementoWSDL, $parametros)
	{
		try{

			$client = new Client(['base_uri' => $this->wsdl. $complementoWSDL]);

			$listaParametros = $this->_preparaParametros($parametros);
			$response = $client->request('GET', $complementoWSDL . '/' . $funcao . '?' . $listaParametros);
			
			return simplexml_load_string($response->getBody()->getContents());

	    }catch(Exception $e){

	        return $e->getMessage();

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

}