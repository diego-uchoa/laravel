<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use Carbon\Carbon;

class ApensadoCamaraWsService extends CamaraWsService
{
	
	const COMPLEMENTO_WSDL = 'Proposicoes';

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
	* Recuperar os apensados de uma proposicao na camara
	* @param integer $id_proposicao
	* @param integer $proposicao
	* @return array
	*/
	public function findByProposicao($id_proposicao, $proposicao) {
		$params = array(
			'IdProp' => $proposicao,
		);

		$proposicaoWS = $this->_obterDados('ObterProposicaoPorID',$params);

		$dadosApensados = array();

		if($proposicaoWS->apensadas->proposicao) {
			foreach ($proposicaoWS->apensadas->proposicao as $apensado) {
				$dadosApensados[] = array(
					'id_proposicao' => $id_proposicao,
					'sg_casa_apensado' => 'CD',
					'no_nome_apensado' => $apensado->nomeProposicao,
					'tx_link_apensado' => $this->_montaLinkApensado($apensado->codProposicao),
				);
			}
		}

		return $dadosApensados;
	}

	/**
	* Gera o link publico do apensado no site da Camara com base no codigo dela
	* @param integer $codigo
	* @return string
	*/
	private function _montaLinkApensado($codigo) {
		return 'http://www.camara.gov.br/proposicoesWeb/fichadetramitacao?idProposicao='.$codigo;
	}
}