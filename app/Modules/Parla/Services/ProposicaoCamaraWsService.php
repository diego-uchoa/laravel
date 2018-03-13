<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use App\Modules\Parla\Repositories\TipoSituacaoRepository;

class ProposicaoCamaraWsService extends CamaraWsService
{
	
	const COMPLEMENTO_WSDL = 'Proposicoes';

	private $tipoSituacaoRepository;

	public function __construct(TipoSituacaoRepository $tipoSituacaoRepository)
	{
	     $this->tipoSituacaoRepository = $tipoSituacaoRepository;
	     parent::__construct();
	}

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
	* Recuperar todas as proposicoes de uma determinada sigla e ano
	* @return 
	*/
	public function findAll() {
		$params  = array(
			'sigla' => 'PL', 
			'numero' => '', 
			'ano' => '2011', 
			'datApresentacaoIni' => '',
			'datApresentacaoFim' => '',
			'parteNomeAutor' => '', 
			'idTipoAutor' => '', 
			'siglaPartidoAutor' => '', 
			'siglaUFAutor' => '', 
			'generoAutor' => '', 
			'codEstado' => '', 
			'codOrgaoEstado' => '', 
			'emTramitacao' => '', 
		);

		$proposicoesWS = $this->_obterDados('ListarProposicoes',$params);
	}

	/**
	* Recuperar dados de uma determinada proposicao de origem na camara
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findOrigemBySiglaNumeroAno($sigla, $numero, $ano) {
		$params  = array(
			'sigla' => $sigla, 
			'numero' => $numero, 
			'ano' => $ano, 
			'datApresentacaoIni' => '',
			'datApresentacaoFim' => '',
			'parteNomeAutor' => '', 
			'idTipoAutor' => '', 
			'siglaPartidoAutor' => '', 
			'siglaUFAutor' => '', 
			'generoAutor' => '', 
			'codEstado' => '', 
			'codOrgaoEstado' => '', 
			'emTramitacao' => '', 
		);

		$proposicaoWS = $this->_obterDados('ListarProposicoes',$params);

		$codigo = $proposicaoWS->proposicao->id;

		$dadosProposicao = array(
			'co_codigo_origem' => $proposicaoWS->proposicao->id,
			'sg_sigla_origem' => strtoupper($proposicaoWS->proposicao->tipoProposicao->sigla),
			'nr_numero_origem' => $proposicaoWS->proposicao->numero,
			'an_ano_origem' => $proposicaoWS->proposicao->ano,
			'sg_casa_origem' => 'CD',
			'tx_link_origem' => $this->_montaLinkProposicao($codigo),
			'tx_terminativo_origem' => $this->_buscaIndicadorTerminativo($proposicaoWS->proposicao->apreciacao->id),
			'in_regime_tramitacao_origem' => $this->_buscaRegimeTramitacao($proposicaoWS->proposicao->regime->codRegime),
			'tx_ementa' => $proposicaoWS->proposicao->txtEmenta,
			'tx_palavra_chave' => $this->_buscaPalavraChave($codigo),
			'in_situacao_origem' => $this->_defineSituacao($proposicaoWS->proposicao->situacao->id),
			'tx_situacao_origem' => $this->_buscaDescricaoSituacao($codigo),
			'tx_norma_gerada' => $this->_buscaNormaGerada($proposicaoWS->proposicao->situacao->id, $proposicaoWS->proposicao->id),
		);

		return $dadosProposicao;
	}

	/**
	* Gera o link publico da proposicao no site da Camara com base no codigo dela
	* @param integer $codigo
	* @return string
	*/
	private function _montaLinkProposicao($codigo) {
		return 'http://www.camara.gov.br/proposicoesWeb/fichadetramitacao?idProposicao='.$codigo;
	}

	/**
	* Retorna se a proposicao possui indicador de despacho terminativo ou nao
	* @param integer $codigo
	* @return boolean
	*/
	private function _buscaIndicadorTerminativo($codigo) {
		
		if($codigo == '4') { //id de apreciacao conclusiva pelas comissoes
			return "Apreciação conclusiva pelas comissões";
		}
		else if($codigo == '5') { //id de apreciacao no plenario
			return "Apreciação no Plenário";
		}
		return null;
	}

	/**
	* Retorna o tipo de regime de tramitacao da proposicao
	* @param integer $codigo
	* @return string
	*/
	private function _buscaRegimeTramitacao($codigo) {
		
		switch ($codigo) {
			case '103':
			case '104':
			case '18':
				$regime = 'E';
				break;
			case '14':
				$regime = 'O';
				break;
			case '20':
				$regime = 'P';
				break;
			case '15':
			case '21':
			case '22':
				$regime = 'U';
				break;
			default:
				$regime = null;
				break;
		}

		return $regime;
	}

	/**
	* Retorna se a proposicao existe no webservice da camara
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return boolean
	*/
	public function existeProposicao($sigla, $numero, $ano) {
		$params = array(
			'tipo' => $sigla, 
			'numero' => $numero, 
			'ano' => $ano,
		);

		$proposicaoWS = $this->_obterDados('ObterProposicao',$params);

		if($proposicaoWS->descricao == 'A Proposição procurada não existe.') {
			return FALSE;
		}

		return TRUE;
	}

	/**
	* Retorna se a proposicao possui origem na camara ou nao
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return boolean
	*/
	public function isOrigem($sigla, $numero, $ano) {
		$params = array(
			'tipo' => $sigla, 
			'numero' => $numero, 
			'ano' => $ano,
		);

		$proposicaoWS = $this->_obterDados('ObterProposicao',$params);

		if(trim($proposicaoWS->nomeProposicaoOrigem) == '') {
			return TRUE;
		}

		return FALSE;
	}

	/**
	* Retorna as palavras chaves de uma proposicao
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return string
	*/
	private function _buscaPalavraChave($codigo) {
		$params = array(
			'IdProp' => $codigo, 
		);

		$proposicaoWS = $this->_obterDados('ObterProposicaoPorID',$params);

		return $proposicaoWS->Indexacao;
	}

	/**
	* Retorna a descricao da situacao de uma proposicao
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return string
	*/
	private function _buscaDescricaoSituacao($codigo) {
		$params = array(
			'IdProp' => $codigo, 
		);

		$proposicaoWS = $this->_obterDados('ObterProposicaoPorID',$params);

		return $proposicaoWS->Situacao;
	}

	/**
	* Retorna o tipo da situacao atual da proposicao
	* @param int $codigo
	* @return string
	*/
	private function _defineSituacao($codigoSituacao) {
		if(trim($codigoSituacao)) {
			$situacao = $this->tipoSituacaoRepository->findOneBy(array(['co_tipo_situacao', '=', $codigoSituacao],['sg_casa_situacao', '=', 'CD']));

			if($situacao) {		
				return $situacao->sg_status_situacao;
			}
			else {
				return 'I';
			}
		}
		else {
			return 'I';
		}
	}

	/**
	* Retorna a norma gerada a partir do id da situacao
	* @param integer $codigo
	* @return string
	*/
	private function _buscaNormaGerada($situacao, $proposicao) {

		if($situacao == 1140) { //id da situacao Transformado em Norma Jurídica
			$params = array(
				'IdProp' => $proposicao, 
			);

			$proposicaoWS = $this->_obterDados('ObterProposicaoPorID',$params);

			return $proposicaoWS->Situacao;
		}

		return null;
	}

	/**
	* Verifica qual o revisora na CD de uma proposicao no SF
	* @param array
	* @param array
	* @return array
	*/
	public function findRevisoraByOutrosNumeros($proposicao, $outrosNumeros) {
		foreach ($outrosNumeros as $outroNumero) {
			//TODO: pegar ObterProposicao para pegar numero Origem
			$params  = array(
				'sigla' => str_replace('.','', $outroNumero->SiglaSubtipoMateria), 
				'numero' => $outroNumero->NumeroMateria, 
				'ano' => $outroNumero->AnoMateria, 
				'datApresentacaoIni' => '',
				'datApresentacaoFim' => '',
				'parteNomeAutor' => '', 
				'idTipoAutor' => '', 
				'siglaPartidoAutor' => '', 
				'siglaUFAutor' => '', 
				'generoAutor' => '', 
				'codEstado' => '', 
				'codOrgaoEstado' => '', 
				'emTramitacao' => '', 
			);

			$proposicaoWS = $this->_obterDados('ListarProposicoes',$params);

			$params = array(
				'IdProp' => $proposicaoWS->proposicao->id, 
			);

			$origemWS = $this->_obterDados('ObterProposicaoPorID',$params);

			if($origemWS->nomeProposicaoOrigem == $proposicao['sg_sigla_origem'].' '.(int) $proposicao['nr_numero_origem'].'/'.$proposicao['an_ano_origem']) {
				$dadosRevisora = array(
					'sn_possui_revisora' => TRUE,
					'co_codigo_revisora' => $proposicaoWS->proposicao->id,
					'sg_sigla_revisora' => strtoupper($proposicaoWS->proposicao->tipoProposicao->sigla),
					'nr_numero_revisora' => $proposicaoWS->proposicao->numero,
					'an_ano_revisora' => $proposicaoWS->proposicao->ano,
					'sg_casa_revisora' => 'CD',
					'tx_link_revisora' => $this->_montaLinkProposicao($proposicaoWS->proposicao->id),
					'tx_terminativo_revisora' => $this->_buscaIndicadorTerminativo($proposicaoWS->proposicao->apreciacao->id),
					'in_regime_tramitacao_revisora' => $this->_buscaRegimeTramitacao($proposicaoWS->proposicao->regime->codRegime),
					'in_situacao_revisora' => $this->_defineSituacao($proposicaoWS->proposicao->situacao->id),
					'tx_situacao_revisora' => $this->_buscaDescricaoSituacao($proposicaoWS->proposicao->id),
				);

				return $dadosRevisora;
			}

		}

		return array();
	}

}