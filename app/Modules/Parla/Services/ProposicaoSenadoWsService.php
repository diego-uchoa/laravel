<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use App\Modules\Parla\Repositories\TipoSituacaoRepository;


class ProposicaoSenadoWsService extends SenadoWsService
{
	
	const COMPLEMENTO_WSDL = 'materia';

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
	* Recuperar todas as proposicoes em tramitacao/que tramitaram no senado na legislatura atual
	* @return 
	*/
	public function findAll() {
		$proposicoesWS = $this->_obterDados('legislaturaatual', array());    

		foreach ($proposicoesWS->Materias->Materia as $proposicao) {
			echo $proposicao->IdentificacaoMateria->SiglaSubtipoMateria . ' ' . $proposicao->IdentificacaoMateria->NumeroMateria . '/' . $proposicao->IdentificacaoMateria->AnoMateria . '<br>';
		}
	}

	/**
	* Recuperar dados de uma determinada proposicao de origem no senado
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findOrigemBySiglaNumeroAno($sigla, $numero, $ano) {
		$proposicaoWS = $this->_obterDados($sigla.'/'.$numero.'/'.$ano, array());

		$codigo = $proposicaoWS->Materia->IdentificacaoMateria->CodigoMateria;

		$dadosProposicao = array(
			'co_codigo_origem' => $proposicaoWS->Materia->IdentificacaoMateria->CodigoMateria,
			'sg_sigla_origem' => strtoupper($proposicaoWS->Materia->IdentificacaoMateria->SiglaSubtipoMateria),
			'nr_numero_origem' => $proposicaoWS->Materia->IdentificacaoMateria->NumeroMateria,
			'an_ano_origem' => $proposicaoWS->Materia->IdentificacaoMateria->AnoMateria,
			'sg_casa_origem' => strtoupper($proposicaoWS->Materia->CasaIniciadoraNoLegislativo->SiglaCasaIniciadora),
			'tx_link_origem' => $this->_montaLinkProposicao($codigo),
			'tx_terminativo_origem' => $this->_buscaIndicadorDespachoTerminativo($codigo),
			'in_regime_tramitacao_origem' => $this->_buscaRegimeTramitacao($codigo),
			'tx_ementa' => $proposicaoWS->Materia->DadosBasicosMateria->EmentaMateria,
			'tx_palavra_chave' => $proposicaoWS->Materia->DadosBasicosMateria->IndexacaoMateria,
			'in_situacao_origem' => $this->_defineSituacao($proposicaoWS->Materia->SituacaoAtual->Autuacoes->Autuacao->Situacao->CodigoSituacao),
			'tx_situacao_origem' => $proposicaoWS->Materia->SituacaoAtual->Autuacoes->Autuacao->Situacao->DescricaoSituacao,
			'tx_norma_gerada' => $this->_buscaNormaGerada($codigo),
		);

		return $dadosProposicao;
	}

	/**
	* Gera o link publico da proposicao no site do Senado com base no codigo dela
	* @param integer $codigo
	* @return string
	*/
	private function _montaLinkProposicao($codigo) {
		return 'https://www25.senado.leg.br/web/atividade/materias/-/materia/'.$codigo;
	}

	/**
	* Retorna se a proposicao possui indicador de despacho terminativo ou nao
	* @param integer $codigo
	* @return boolean
	*/
	private function _buscaIndicadorDespachoTerminativo($codigo) {
		$movimentacoesWS = $this->_obterDados('movimentacoes/'.$codigo, array());

		$terminativo = '';	

		if($movimentacoesWS->Materia->Despachos->Despacho) {
			foreach ($movimentacoesWS->Materia->Despachos as $despachos) {
				$ultimoDespacho = $movimentacoesWS->Materia->Despachos->Despacho[sizeof($despachos)-1];
				foreach ($ultimoDespacho->ComissoesDespacho as $comissoes) {
					foreach ($comissoes->ComissaoDespacho as $comissao) {
						if($comissao->IndicadorDespachoTerminativo == 'Sim') {
							$comissaoTerminativa = '<b>'.$comissao->IdentificacaoComissao->SiglaComissao.' (T)</b>';
						}
						else {
							$terminativo .= $comissao->IdentificacaoComissao->SiglaComissao;
							$terminativo .= ' / ';
						}
					}
				}
			}
		}

		if(!isset($comissaoTerminativa)) {
			$comissaoTerminativa = '<b>PLEN</b>';
		}

		$terminativo .= $comissaoTerminativa;

		return $terminativo;
	}

	/**
	* Retorna o tipo de regime de tramitacao da proposicao
	* @param integer $codigo
	* @return string
	*/
	private function _buscaRegimeTramitacao($codigo) {
		$movimentacoesWS = $this->_obterDados('movimentacoes/'.$codigo, array());

		$regimeTramitacao = 'O'; //tramitacao ordinaria - padrao

		if($movimentacoesWS->Materia->Prazos) {
			foreach ($movimentacoesWS->Materia->Prazos as $prazos) {
				foreach ($prazos->Prazo as $prazo) {
					if($prazo->CodigoTipoPrazo == 6) { //codigo de prazo Tramitação em regime de urgência
						$regimeTramitacao = 'U'; //tramitacao urgente
					}
				}
			}
		}

		return $regimeTramitacao;
	}

	/**
	* Retorna se a proposicao possui origem no senado ou nao
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return boolean
	*/
	public function existeProposicao($sigla, $numero, $ano) {
		$proposicaoWS = $this->_obterDados($sigla.'/'.$numero.'/'.$ano, array());

		if(!$proposicaoWS->Materia) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	* Retorna se a proposicao possui origem no senado ou nao
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return boolean
	*/
	public function isOrigem($sigla, $numero, $ano) {
		$proposicaoWS = $this->_obterDados($sigla.'/'.$numero.'/'.$ano, array());

		if($proposicaoWS->Materia->CasaIniciadoraNoLegislativo->SiglaCasaIniciadora == 'SF') {
			return TRUE;
		}
		return FALSE;
	}

	/**
	* Retorna o tipo da situacao atual da proposicao
	* @param integer $codigoSituacao
	* @return string
	*/
	private function _defineSituacao($codigoSituacao) {
		
		$situacao = $this->tipoSituacaoRepository->findOneBy(array(['co_tipo_situacao', '=', $codigoSituacao],['sg_casa_situacao', '=', 'SF']));

		if($situacao) {		
			return $situacao->sg_status_situacao;
		}
		else {
			return 'I';
		}
	}

	/**
	* Retorna o nome da norma gerada
	* @param integer $codigo
	* @return string
	*/
	private function _buscaNormaGerada($codigo) {
		$proposicaoWS = $this->_obterDados($codigo, array());

		if($proposicaoWS->Materia->NormaGerada) {
			$norma = $proposicaoWS->Materia->NormaGerada->IdentificacaoNorma;

			return $norma->SiglaTipoNorma.' '.$norma->NumeroNorma.'/'.$norma->AnoNorma;
		}
		else {
			return null;
		}
	}

	/**
	* Retorna os dados de uma proposicao revisora a partir de uma de origem na CD
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findRevisoraByOrigem($sigla, $numero, $ano) {
		if($sigla == 'PL') {
			$sigla = 'PL.';
		}
		
		$params = array(
			'sigla' => $sigla, 
			'numero' => $numero, 
			'ano' => $ano, 
		);
		$proposicaoWS = $this->_obterDados('pesquisa/lista', $params);

		if($proposicaoWS->Materias) {
			$codigo = $proposicaoWS->Materias->Materia->IdentificacaoMateria->CodigoMateria;

			$dadosRevisora = array(
				'sn_possui_revisora' => TRUE,
				'co_codigo_revisora' => $codigo,
				'sg_sigla_revisora' => $proposicaoWS->Materias->Materia->IdentificacaoMateria->SiglaSubtipoMateria,
				'nr_numero_revisora' => $proposicaoWS->Materias->Materia->IdentificacaoMateria->NumeroMateria,
				'an_ano_revisora' => $proposicaoWS->Materias->Materia->IdentificacaoMateria->AnoMateria,
				'sg_casa_revisora' => $proposicaoWS->Materias->Materia->IdentificacaoMateria->SiglaCasaIdentificacaoMateria,
				'tx_link_revisora' => $this->_montaLinkProposicao($codigo),
				'tx_terminativo_revisora' => $this->_buscaIndicadorDespachoTerminativo($codigo),
				'in_regime_tramitacao_revisora' => $this->_buscaRegimeTramitacao($codigo),
				'in_situacao_revisora' => $this->_defineSituacao($proposicaoWS->Materias->Materia->SituacaoAtual->Autuacoes->Autuacao->Situacao->CodigoSituacao),
				'tx_situacao_revisora' => $proposicaoWS->Materias->Materia->SituacaoAtual->Autuacoes->Autuacao->Situacao->DescricaoSituacao,
			);

			return $dadosRevisora;
		}

		return array();
	}

	/**
	* Retorna outros números na CD de uma proposicao de origem no SF
	* @param string $sigla
	* @param integer $numero
	* @param integer $ano
	* @return array
	*/
	public function findOutrosNumerosByOrigem($sigla, $numero, $ano) {
		$proposicaoWS = $this->_obterDados($sigla.'/'.$numero.'/'.$ano, array());

		if($proposicaoWS->Materia->OutrosNumerosDaMateria) {
			foreach ($proposicaoWS->Materia->OutrosNumerosDaMateria->OutroNumeroDaMateria as $outroNumero) {
				if($outroNumero->IdentificacaoMateria->SiglaCasaIdentificacaoMateria == 'CD') {
					$dadosOutroNumero[] = $outroNumero->IdentificacaoMateria;
				}
			}
			
			return $dadosOutroNumero;
		}
		
		return array();
	}

}