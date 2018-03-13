<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;

class ApensadoSenadoWsService extends SenadoWsService
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
	* Recuperar dados dps apensados de uma proposicao no Senado
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findByProposicao($id_proposicao, $proposicao) {
		$proposicaoWS = $this->_obterDados($proposicao, array());

		$dadosApensados = array();

		if($proposicaoWS->Materia->MateriasAnexadas) {
			foreach ($proposicaoWS->Materia->MateriasAnexadas->children() as $apensado) {
				if(!$apensado->DataDesanexacao) {
					$dadosApensados[] = array(
						'id_proposicao' => $id_proposicao,
						'sg_casa_apensado' => $apensado->IdentificacaoMateria->SiglaCasaIdentificacaoMateria,
						'no_nome_apensado' => $apensado->IdentificacaoMateria->SiglaSubtipoMateria.' '.$apensado->IdentificacaoMateria->NumeroMateria.'/'.$apensado->IdentificacaoMateria->AnoMateria,
						'tx_link_apensado' => $this->_montaLinkApensado($apensado->IdentificacaoMateria->CodigoMateria),
					);
				}
			}
		}

		return $dadosApensados;
	}

	/**
	* Gera o link publico do apensado de uma proposicao no site do Senado com base no codigo dela
	* @param integer $codigo
	* @return string
	*/
	private function _montaLinkApensado($codigo) {
		return 'https://www25.senado.leg.br/web/atividade/materias/-/materia/'.$codigo;
	}
}