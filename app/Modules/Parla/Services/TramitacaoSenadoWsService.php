<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;

class TramitacaoSenadoWsService extends SenadoWsService
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
		$proposicaoWS = $this->_obterDados('movimentacoes/'.$proposicao, array());

		$dadosEmendas = array();

		if($proposicaoWS->Materia->Tramitacoes->Tramitacao) {
			foreach ($proposicaoWS->Materia->Tramitacoes->Tramitacao as $tramitacao) {
				$dadosTramitacoes[] = array(
					'id_proposicao' => $id_proposicao,
					'sg_casa_tramitacao' => 'SF',
					'co_codigo_tramitacao' => $tramitacao->IdentificacaoTramitacao->CodigoTramitacao,
					'dt_data_tramitacao' => $tramitacao->IdentificacaoTramitacao->DataTramitacao,
					'no_orgao_tramitacao' => $tramitacao->IdentificacaoTramitacao->OrigemTramitacao->Local->SiglaLocal.' - '.$tramitacao->IdentificacaoTramitacao->OrigemTramitacao->Local->NomeLocal,
					'tx_andamento' => $tramitacao->IdentificacaoTramitacao->TextoTramitacao,
				);
			}
		}
		
		return $dadosTramitacoes;
	}
}