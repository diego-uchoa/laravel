<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;

class MateriaRelacionadaSenadoWsService extends SenadoWsService
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
	* Recuperar dados das materias relacionadas de uma proposicao no Senado
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findByProposicao($id_proposicao, $proposicao) {
		$proposicaoWS = $this->_obterDados($proposicao, array());

		$dadosMateriasRelacionadas = array();

		if($proposicaoWS->Materia->MateriasRelacionadas->MateriaRelacionada) {
			foreach ($proposicaoWS->Materia->MateriasRelacionadas->MateriaRelacionada as $materiaRelacionada) {
				$dadosMateriasRelacionadas[] = array(
					'id_proposicao' => $id_proposicao,
					'sg_casa_materia' => 'SF',
					'no_nome_materia' => $materiaRelacionada->IdentificacaoMateria->SiglaSubtipoMateria.' - '.$materiaRelacionada->IdentificacaoMateria->DescricaoSubtipoMateria.' '.$materiaRelacionada->IdentificacaoMateria->NumeroMateria.' de '.$materiaRelacionada->IdentificacaoMateria->AnoMateria,
					'tx_link_materia' => $this->_montaLinkMateriaRelacionada($materiaRelacionada->IdentificacaoMateria->CodigoMateria),
				);
			}
		}
		
		return $dadosMateriasRelacionadas;
	}

	/**
	* Gera o link publico da materia relacionada de uma proposicao no site do Senado com base no codigo dela
	* @param integer $codigo
	* @return string
	*/
	private function _montaLinkMateriaRelacionada($codigo) {
		return 'https://www25.senado.leg.br/web/atividade/materias/-/materia/'.$codigo;
	}
}