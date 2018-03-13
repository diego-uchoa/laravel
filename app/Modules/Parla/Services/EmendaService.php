<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\EmendaRepository;
use Illuminate\Http\Request;
use Exception;
use DB;

class EmendaService {
	protected $emendaRepository;
	protected $emendaSenadoWsService;
	protected $emendaCamaraWsService;

	public function __construct(EmendaRepository $emendaRepository, EmendaCamaraWsService $emendaCamaraWsService, EmendaSenadoWsService $emendaSenadoWsService) {
		$this->emendaRepository = $emendaRepository;
		$this->emendaCamaraWsService = $emendaCamaraWsService;
		$this->emendaSenadoWsService = $emendaSenadoWsService;
	}

	public function store($proposicao) {
		$emendasOrigem = array();
		$emendasRevisora = array();

		try {
			$emendasOrigem = $this->_findEmendasOrigemByProposicao($proposicao, $proposicao->sg_casa_origem);
			$emendasRevisora = $this->_findEmendasRevisoraByProposicao($proposicao, $proposicao->sg_casa_revisora);

			if ($emendasOrigem){
				foreach ($emendasOrigem as $emendaOrigem) {
					$this->emendaRepository->firstOrCreate($emendaOrigem);		
				}
			}

			if ($emendasRevisora){
				foreach ($emendasRevisora as $emendaRevisora) {
					$this->emendaRepository->firstOrCreate($emendaRevisora);
				}	
			}
			
		} catch(\Exception $e) {

			throw new \Exception('Erro ao realizar o cadastro de Emendas ('. $e->getMessage() .')');
			
		}

	}

	private function _findEmendasOrigemByProposicao($proposicao, $sg_sigla) {
		if($sg_sigla == 'SF') {
			return $this->emendaSenadoWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_origem);
		}
		else if($sg_sigla == 'CD') {
			return $this->emendaCamaraWsService->findByProposicao($proposicao->id_proposicao, $proposicao->sg_sigla_origem, $proposicao->nr_numero_origem, $proposicao->an_ano_origem);
		}
	}

	private function _findEmendasRevisoraByProposicao($proposicao, $sg_sigla) {
		if($proposicao->sn_possui_revisora) {
			if($sg_sigla == 'SF') {
				return $this->emendaSenadoWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_revisora);
			}
			else if($sg_sigla == 'CD') {
				return $this->emendaCamaraWsService->findByProposicao($proposicao->id_proposicao, $proposicao->sg_sigla_revisora, $proposicao->nr_numero_revisora, $proposicao->an_ano_revisora);
			}
		}
	}

}