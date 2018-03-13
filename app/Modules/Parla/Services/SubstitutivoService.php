<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\SubstitutivoRepository;
use Illuminate\Http\Request;
use Exception;
use DB;

class SubstitutivoService {
	protected $substitutivoRepository;
	protected $substitutivoCamaraWsService;

	public function __construct(SubstitutivoRepository $substitutivoRepository, SubstitutivoCamaraWsService $substitutivoCamaraWsService) {
		$this->substitutivoRepository = $substitutivoRepository;
		$this->substitutivoCamaraWsService = $substitutivoCamaraWsService;
	}

	public function store($proposicao) {
		$substitutivosCamara = array();

		if($proposicao->sg_casa_origem == 'CD') {
			$substitutivosCamara = $this->substitutivoCamaraWsService->findByProposicao($proposicao->id_proposicao, $proposicao->sg_sigla_origem, $proposicao->nr_numero_origem, $proposicao->an_ano_origem);
		}

		if($proposicao->sn_possui_revisora) {
			if($proposicao->sg_casa_revisora == 'CD') {
				$substitutivosCamara = $this->substitutivoCamaraWsService->findByProposicao($proposicao->id_proposicao, $proposicao->sg_sigla_revisora, $proposicao->nr_numero_revisora, $proposicao->an_ano_revisora);
			}
		}

		try {

			foreach ($substitutivosCamara as $substitutivoCamara) {
				$this->substitutivoRepository->firstOrCreate($substitutivoCamara);
			}

		} catch(\Exception $e) {
			
			throw new \Exception('Erro ao realizar o cadastro de Substitutivo ('. $e->getMessage() .')');

		}
	}

}