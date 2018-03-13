<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use Carbon\Carbon;

class ComissaoCamaraWsService extends CamaraWsService
{
	
	const COMPLEMENTO_WSDL = 'Orgaos';

	private $parlamentarService;

	public function __construct(ParlamentarService $parlamentarService)
	{
	     $this->parlamentarService = $parlamentarService;
	     parent::__construct();
	}

	/**
	* Recuperar os dados da função passada por parametros
	* @param  string $funcao
	* @param  array $parametros
	* @return string
	*/
	private function _obterDados($funcao, $parametros) {
		try{

			return parent::getClient($funcao, self::COMPLEMENTO_WSDL, $parametros);

	    }catch(Exception $e){

	        return null;

	    }

	}

	/**
	* Recuperar dados comissoes da camara
	* @return array
	*/
	public function all() {
		$params  = array();

		$orgaosWS = $this->_obterDados('ObterOrgaos',$params);

		$dadosComissoes = array();

		foreach ($orgaosWS->orgao as $orgao) {
			if($this->_isComissao($orgao['idTipodeOrgao'])) {
				$dadosComissoes[] = array(
					'co_comissao' => $orgao['id'],
					'sg_casa' => 'CD',
					'sg_comissao' => $orgao['sigla'],
					'no_comissao' => $orgao['descricao'],
					'in_tipo' => $this->_defineTipoComissao($orgao['idTipodeOrgao']),
				);
			}
		}

		return $dadosComissoes;
	}

	/**
	* Verifica se um orgao é uma comissão
	* @param  integer $tipoOrgao
	* @return boolean
	*/
	private function _isComissao($tipoOrgao) {
		//Tipos de orgaos obtidos em http://www.camara.leg.br/SitCamaraWS/Orgaos.asmx/ListarTiposOrgaos
		$comissoes = array(
			"2" => "Comissão Permanente",
			"3" => "Comissão Especial",
			"5" => "Comissão Externa",
			"9" => "Comissão Medida Provisória",
			"4" => "Comissão Parlamentar de Inquérito",
			"13000" => "Comissão Temporária da CD",
		);

		if(array_key_exists((int) $tipoOrgao,$comissoes)) {
			return true;
		}
		else {
			return false;
		}
	}

	/**
	* Define tipo comissao
	* @param  integer $tipoComissao
	* @return char
	*/
	private function _defineTipoComissao($tipoComissao) {
		//Tipos de orgaos obtidos em http://www.camara.leg.br/SitCamaraWS/Orgaos.asmx/ListarTiposOrgaos
		$tiposComissao = array(
			"2" => "P", //permanente
			"3" => "T", //temporaria
			"5" => "T",
			"4" => "T",
			"13000" => "T",
		);

		return $tiposComissao[(int) $tipoComissao];
	}

	/**
	* Recuperar membros comissoes da camara
	* @return array
	*/
	public function obterMembros($comissao) {
		$params  = array(
			'IDOrgao' => $comissao->co_comissao,
		);

		$membrosWS = $this->_obterDados('ObterMembrosOrgao',$params);

		$dadosMembros = array();

		set_time_limit(0);

		foreach ($membrosWS->membros->Titular as $membro) {
			$dadosMembros[] = array(
				'id_parlamentar' => $this->parlamentarService->store($membro->ideCadastro, 'DEP')->id_parlamentar,
				'in_cargo' => 'T'
			);
		}

		foreach ($membrosWS->membros->Suplente as $membro) {
			$dadosMembros[] = array(
				'id_parlamentar' => $this->parlamentarService->store($membro->ideCadastro, 'DEP')->id_parlamentar,
				'in_cargo' => 'S'
			);
		}

		return $dadosMembros;
	}
}