<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;

class EmendaSenadoWsService extends SenadoWsService
{
	
	const COMPLEMENTO_WSDL = 'materia';

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
	* Recuperar dados das emendas de uma proposicao no Senado
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findByProposicao($id_proposicao, $proposicao) {
		$emendasWS = $this->_obterDados('emendas/'.$proposicao, array());

		$dadosEmendas = array();

		if($emendasWS->Materia->Emendas->Emenda) {
			foreach ($emendasWS->Materia->Emendas->Emenda as $emenda) {
				$dadosEmendas[] = array(
					'id_proposicao' => $id_proposicao,
					'sg_casa_emenda' => 'SF',
					'co_codigo_emenda' => $emenda->CodigoEmenda,
					'no_nome_emenda' => 'EMENDA '.$emenda->NumeroEmenda.' '.$emenda->ColegiadoApresentacao,
					'tx_link_emenda' => $emenda->TextosEmenda ? $emenda->TextosEmenda->TextoEmenda->UrlTexto : '#' ,
				);
			}
		}
		
		return $dadosEmendas;
	}
}