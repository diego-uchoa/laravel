<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use Carbon\Carbon;

class TramitacaoCamaraWsService extends CamaraWsService
{
	
	const COMPLEMENTO_WSDL = 'Orgaos';

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
	* Recuperar dados das tramitacoes de uma proposicao na camara
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findByProposicao($id_proposicao, $sigla, $numero, $ano) {
		$params  = array(
			'sigla' => $sigla, 
			'numero' => $numero, 
			'ano' => $ano, 
			'dataIni' => '',
			'codOrgao' => ''
		);

		$tramitacoesWS = $this->_obterDados('ObterAndamento',$params);

		$dadosTramitacoes = array();

		$dadosTramitacoes[] = array(
			'id_proposicao' => $id_proposicao,
			'sg_casa_tramitacao' => 'CD',
			'co_codigo_tramitacao' => $tramitacoesWS->ultimaAcao->tramitacao->ordemDeTramitacao,
			'dt_data_tramitacao' => Carbon::createFromFormat('d/m/Y', $tramitacoesWS->ultimaAcao->tramitacao->data)->format('Y-m-d'),
			'no_orgao_tramitacao' => $tramitacoesWS->ultimaAcao->tramitacao->orgao,
			'tx_andamento' => $tramitacoesWS->ultimaAcao->tramitacao->descricao,
		);

		foreach ($tramitacoesWS->andamento->tramitacao as $tramitacao) {
			$dadosTramitacoes[] = array(
				'id_proposicao' => $id_proposicao,
				'sg_casa_tramitacao' => 'CD',
				'co_codigo_tramitacao' => $tramitacao->ordemDeTramitacao,
				'dt_data_tramitacao' => Carbon::createFromFormat('d/m/Y', $tramitacao->data)->format('Y-m-d'),
				'no_orgao_tramitacao' => $tramitacao->orgao,
				'tx_andamento' => $tramitacao->descricao,
			);
		}

		return $dadosTramitacoes;
	}
}