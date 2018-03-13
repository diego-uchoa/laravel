<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\TramitacaoRepository;
use Illuminate\Http\Request;
use Exception;
use DB;

class TramitacaoService {
	protected $tramitacaoRepository;
	protected $tramitacaoSenadoWsService;
	protected $tramitacaoCamaraWsService;

	public function __construct(TramitacaoRepository $tramitacaoRepository, TramitacaoCamaraWsService $tramitacaoCamaraWsService, TramitacaoSenadoWsService $tramitacaoSenadoWsService) {
		$this->tramitacaoRepository = $tramitacaoRepository;
		$this->tramitacaoCamaraWsService = $tramitacaoCamaraWsService;
		$this->tramitacaoSenadoWsService = $tramitacaoSenadoWsService;
	}

	public function store($proposicao) {
		$tramitacoesOrigem = array();
		$tramitacoesRevisora = array();

		$tramitacoesOrigem = $this->_findTramitacoesOrigemByProposicao($proposicao, $proposicao->sg_casa_origem);
		$tramitacoesRevisora = $this->_findTramitacoesRevisoraByProposicao($proposicao, $proposicao->sg_casa_revisora);
		
		try {

			if ($tramitacoesOrigem){
				foreach ($tramitacoesOrigem as $tramitacaoOrigem) {
					$this->tramitacaoRepository->firstOrCreate($tramitacaoOrigem);
				}	
			}
			
			if ($tramitacoesRevisora){
				foreach ($tramitacoesRevisora as $tramitacaoRevisora) {
					$this->tramitacaoRepository->firstOrCreate($tramitacaoRevisora);
				}
			}

		} catch(\Exception $e) {
			
			throw new \Exception('Erro ao realizar o cadastro de Tramitacoes ('. $e->getMessage() .')');

		}
	}

	private function _findTramitacoesOrigemByProposicao($proposicao, $sg_sigla) {
		if($sg_sigla == 'SF') {
			return $this->tramitacaoSenadoWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_origem);
		}
		else if($sg_sigla == 'CD') {
			return $this->tramitacaoCamaraWsService->findByProposicao($proposicao->id_proposicao, $proposicao->sg_sigla_origem, $proposicao->nr_numero_origem, $proposicao->an_ano_origem);
		}
	}

	private function _findTramitacoesRevisoraByProposicao($proposicao, $sg_sigla) {
		if($proposicao->sn_possui_revisora) {
			if($sg_sigla == 'SF') {
				return $this->tramitacaoSenadoWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_revisora);
			}
			else if($sg_sigla == 'CD') {
				return $this->tramitacaoCamaraWsService->findByProposicao($proposicao->id_proposicao, $proposicao->sg_sigla_revisora, $proposicao->nr_numero_revisora, $proposicao->an_ano_revisora);
			}
		}
	}

}