<?php
namespace App\Modules\Gescon\Services;

use Illuminate\Support\Collection;
use Exception;
use Carbon\Carbon;

class ContratoSiasgWsService extends SiasgWsService
{
	const COMPLEMENTO_WSDL = 'contratos';

	/**
	* Recuperar os dados da função passada por parametros
	* @param  string $funcao
	* @param  array $parametros
	* @return string
	*/
	private function _obterDados($funcao, $parametros)
	{
		try{

			return json_decode(parent::getClient($funcao, self::COMPLEMENTO_WSDL, $parametros));

	    }catch(Exception $e){

	        throw new Exception('Erro: Não foi possível encontrar o contrato.', 999);

	    }

	}


	/**
	* Recuperar dados do contrato no WS através do Identificador
	* @param integer identificador
	* @return Array
	*/
	private function findContratoByIdentificador($identificador)
	{
		$parametros = [];
		$funcao = 'id/contrato/'. $identificador .'.json';

		try{
			$ContratoWS = $this->_obterDados($funcao, $parametros);
			if ($ContratoWS){
				return $ContratoWS;
			}else{
				return "";
			}

		}catch (Exception $e){

			return "";

		}
		
	}

	/**
	* Recuperar o identificador do contrato no WS através do Nº do Contrato e Código UASG
	* @param integer nu_contrato
	* @param integer co_uasg
	* @return Integer
	*/
	public function findContratoByNuContratoCoUasg($nu_contrato, $co_uasg)
	{
		$array_retorno = [];
		$parametros = ['numero' => $nu_contrato, 'uasg' => $co_uasg];

		try{
		
			$ContratoWS = $this->_obterDados('v1/contratos.json', $parametros);
			if ($ContratoWS->_embedded->contratos){
				$contrato = $this->findContratoByIdentificador($ContratoWS->_embedded->contratos[0]->identificador);
				$array_retorno = [
									'modalidade_licitacao' => $contrato->modalidade_licitacao,
									'numero_aviso_licitacao' => str_pad($contrato->numero_aviso_licitacao, 8, "0", STR_PAD_LEFT),
									'numero_processo' => str_pad($contrato->numero_processo, 17, "0", STR_PAD_LEFT),
								];
				return $array_retorno;
			}else{
				return "";
			}

		}catch (Exception $e){

			return "";

		}
	}
}