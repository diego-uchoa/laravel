<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;

class AutoriaSenadoWsService extends SenadoWsService
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
	* Recuperar dados da autoria de uma proposicao no Senado
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findAutorByProposicao($proposicao) {
		$proposicaoWS = $this->_obterDados($proposicao->co_codigo_origem, array());

		if($proposicaoWS->Materia->Autoria->Autor->SiglaTipoAutor == 'SENADOR') {
			$dadosAutoria = array(
				'id_proposicao' => $proposicao->id_proposicao,
				'no_nome_autor' => $proposicaoWS->Materia->Autoria->Autor->NomeAutor,
				'in_tipo_autor' => 'SEN',
				'sg_partido_autor' => $proposicaoWS->Materia->Autoria->Autor->IdentificacaoParlamentar->SiglaPartidoParlamentar,
				'sg_uf_autor' => $proposicaoWS->Materia->Autoria->Autor->UfAutor,
				'co_codigo_parlamentar' => $proposicaoWS->Materia->Autoria->Autor->IdentificacaoParlamentar->CodigoParlamentar,
			);
		}
		else {
			$dadosAutoria = array(
				'id_proposicao' => $proposicao->id_proposicao,
				'no_nome_autor' => $proposicaoWS->Materia->Autoria->Autor->NomeAutor,
				'in_tipo_autor' => 'ENT',
				'sg_partido_autor' => null,
				'sg_uf_autor' => null,
				'co_codigo_parlamentar' => null,
			);
		}
		
		return $dadosAutoria;
	}
}