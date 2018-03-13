<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use Carbon\Carbon;

class SubstitutivoCamaraWsService extends CamaraWsService
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
	* Recuperar dados dos substitutivos de uma proposicao na camara
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

		$substitutivosWS = $this->_obterDados('ObterEmendasSubstitutivoRedacaoFinal','Orgaos',$params);

		$dadosSubstitutivos = array();

		foreach ($substitutivosWS->Substitutivos->Substitutivo as $substitutivo) {
			$dadosSubstitutivos[] = array(
				'id_proposicao' => $id_proposicao,
				'sg_casa_substitutivo' => 'CD',
				'co_codigo_substitutivo' => $substitutivo['CodProposicao'],
				'no_nome_substitutivo' => $substitutivo['Descricao'],
				'tx_link_substitutivo' => 'http://www.camara.gov.br/proposicoesWeb/fichadetramitacao?idProposicao='.$substitutivo['CodProposicao'],
			);
		}

		return $dadosSubstitutivos;
	}
}