<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;

class ComissaoSenadoWsService extends SenadoWsService
{
	
	const COMPLEMENTO_WSDL = 'comissao';

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
		try {
			return parent::getClient($funcao, self::COMPLEMENTO_WSDL, $parametros);
		} catch(Exception $e) {
			return null;
		}
	}

	/**
	* Recuperar dados das comissoes do Senado
	* @return array
	*/
	public function all() {
		$orgaosWS = $this->_obterDados('lista/colegiados',array());

		$dadosComissoes = array();

		if($orgaosWS->Colegiados->Colegiado) {
			foreach ($orgaosWS->Colegiados->Colegiado as $orgao) {
				if($this->_isComissao($orgao->CodigoTipoColegiado)) {
					$dadosComissoes[] = array(
						'co_comissao' => $orgao->Codigo,
						'sg_casa' => 'SF',
						'sg_comissao' => $orgao->Sigla,
						'no_comissao' => $orgao->Nome,
						'in_tipo' => $this->_defineTipoComissao($orgao->CodigoTipoColegiado),
					);
				}
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
		//Tipos de orgaos obtidos em http://legis.senado.leg.br/dadosabertos/comissao/lista/tiposColegiado
		$comissoes = array(
			"21" => "Comissão Permanente",			
			"22" => "Comissão Parlamentar de Inquérito",					
			"24" => "Comissão Temporária Interna",					
			"112" => "Comissão Especial Externa",			
			"121" => "Comissão Temporária Externa",			
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
		//Tipos de orgaos obtidos em http://legis.senado.leg.br/dadosabertos/comissao/lista/tiposColegiado
		$tiposComissao = array(
			"21" => "P", //permanente			
			"22" => "T",						
			"24" => "T",						
			"112" => "T",			
			"121" => "T",	
		);

		return $tiposComissao[(int) $tipoComissao];
	}

	/**
	* Recuperar membros das comissoes do senado
	* @return array
	*/
	public function obterMembros($comissao) {
		$membrosWS = $this->_obterDados($comissao->sg_comissao,array());

		$dadosMembros = array();

		if($membrosWS->COLEGIADO->COLEGIADO_ROW->MEMBROS_BLOCO->MEMBROS_BLOCO_ROW) {
			foreach ($membrosWS->COLEGIADO->COLEGIADO_ROW->MEMBROS_BLOCO->MEMBROS_BLOCO_ROW as $bloco) {
				foreach ($bloco->MEMBROS->MEMBROS_ROW as $membro) {
					if($membro->HTTP) {
						if($membro->TIPO_VAGA == 'Titular') {
							$dadosMembros[] = array(
								'id_parlamentar' => $this->parlamentarService->store((int) $membro->HTTP, 'SEN')->id_parlamentar,
								'in_cargo' => 'T'
							);
						}
						elseif($membro->TIPO_VAGA == 'Suplente') {
							$dadosMembros[] = array(
								'id_parlamentar' => $this->parlamentarService->store((int) $membro->HTTP, 'SEN')->id_parlamentar,
								'in_cargo' => 'S'
							);
						}
					}
				}
			}
		}

		return $dadosMembros;
	}
}