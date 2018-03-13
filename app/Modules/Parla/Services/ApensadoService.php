<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\ApensadoRepository;
use Illuminate\Http\Request;
use Exception;
use DB;

class ApensadoService {
	protected $apensadoRepository;
	protected $apensadoSenadoWsService;
	protected $apensadoCamaraWsService;

	public function __construct(ApensadoRepository $apensadoRepository, ApensadoCamaraWsService $apensadoCamaraWsService, ApensadoSenadoWsService $apensadoSenadoWsService) {
		$this->apensadoRepository = $apensadoRepository;
		$this->apensadoCamaraWsService = $apensadoCamaraWsService;
		$this->apensadoSenadoWsService = $apensadoSenadoWsService;
	}

	public function store($proposicao) {
		$apensadosOrigem = array();
		$apensadosDestino = array();

		$apensadosOrigem = $this->_findApensadosOrigemByProposicao($proposicao, $proposicao->sg_casa_origem);
		$apensadosDestino = $this->_findApensadosRevisoraByProposicao($proposicao, $proposicao->sg_casa_revisora);

		try {

			if ($apensadosOrigem){
				foreach ($apensadosOrigem as $apensados => $apensadoOrigem) {
					$this->apensadoRepository->firstOrCreate($apensadoOrigem);
				}	
			}
			
			if ($apensadosDestino){
				foreach ($apensadosDestino as $apensados => $apensadoDestino) {
					$this->apensadoRepository->firstOrCreate($apensadoDestino);
				}	
			}

		} catch(\Exception $e) {
			
			return response(['msg' => 'Não foi possível realizar o cadastro dos apensados.', 'detail' => $e->getMessage(), 'status' => 'error']);

		}
	}

	private function _findApensadosOrigemByProposicao($proposicao, $sg_sigla) {
		if($sg_sigla == 'SF') {
			return $this->apensadoSenadoWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_origem);
		}
		else if($sg_sigla == 'CD') {
			return $this->apensadoCamaraWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_origem);
		}
	}

	private function _findApensadosRevisoraByProposicao($proposicao, $sg_sigla) {
		if($proposicao->sn_possui_revisora) {
			if($sg_sigla == 'SF') {
				return $this->apensadoSenadoWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_revisora);
			}
			else if($sg_sigla == 'CD') {
				return $this->apensadoCamaraWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_revisora);
			}
		}
	}
}