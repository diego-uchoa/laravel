<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use Carbon\Carbon;

class AutoriaCamaraWsService extends CamaraWsService
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
	* Recuperar dados da autoria de uma proposicao na Câmara
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findAutorByProposicao($proposicao) {
		$params = array(
			'IdProp' => $proposicao->co_codigo_origem,
		);

		$proposicaoWS = $this->_obterDados('ObterProposicaoPorID',$params);

		if(trim($proposicaoWS->ideCadastro) != '') {
			$dadosAutoria = array(
				'id_proposicao' => $proposicao->id_proposicao,
				'no_nome_autor' => $proposicaoWS->Autor,
				'in_tipo_autor' => 'DEP',
				'sg_partido_autor' => $proposicaoWS->partidoAutor,
				'sg_uf_autor' => $proposicaoWS->ufAutor,
				'co_codigo_parlamentar' => $proposicaoWS->ideCadastro,
			);
		}
		else {
			$dadosAutoria = array(
				'id_proposicao' => $proposicao->id_proposicao,
				'no_nome_autor' => $proposicaoWS->Autor,
				'in_tipo_autor' => 'ENT',
				'sg_partido_autor' => null,
				'sg_uf_autor' => null,
				'co_codigo_parlamentar' => null,
			);
		}

		return $dadosAutoria;
	}
}