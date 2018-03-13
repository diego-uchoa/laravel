<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use Carbon\Carbon;

class EmendaCamaraWsService extends CamaraWsService
{
	
	const COMPLEMENTO_WSDL = 'Orgaos';

	/**
	* Recuperar os dados da função passada por parametros
	* @param  string $funcao
	* @param  array $parametros
	* @return string
	*/
	private function _obterDados($funcao, $complemento, $parametros) {
		try{

			return parent::getClient($funcao, $complemento, $parametros);

	    }catch(Exception $e){

	        return null;

	    }

	}

	/**
	* Recuperar dados das emendas de uma proposicao na camara
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findByProposicao($id_proposicao, $sigla, $numero, $ano) {
		$params  = array(
			'tipo' => $sigla, 
			'numero' => $numero, 
			'ano' => $ano, 
		);

		$emendasWS = $this->_obterDados('ObterEmendasSubstitutivoRedacaoFinal','Orgaos',$params);

		$dadosEmendas = array();

		foreach ($emendasWS->Emendas->Emenda as $emenda) {
			$dadosEmendas[] = array(
				'id_proposicao' => $id_proposicao,
				'sg_casa_emenda' => 'CD',
				'co_codigo_emenda' => $emenda['CodProposicao'],
				'no_nome_emenda' => $emenda['Descricao'],
				'tx_link_emenda' => 'http://www.camara.gov.br/proposicoesWeb/fichadetramitacao?idProposicao='.$emenda['CodProposicao'],
			);
		}

		return $dadosEmendas;
	}
}