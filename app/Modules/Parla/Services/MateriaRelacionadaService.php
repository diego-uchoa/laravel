<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\MateriaRelacionadaRepository;
use Illuminate\Http\Request;
use Exception;
use DB;

class MateriaRelacionadaService {
	protected $materiaRelacionadaRepository;
	protected $materiaRelacionadaSenadoWsService;

	public function __construct(MateriaRelacionadaRepository $materiaRelacionadaRepository, MateriaRelacionadaSenadoWsService $materiaRelacionadaSenadoWsService) {
		$this->materiaRelacionadaRepository = $materiaRelacionadaRepository;
		$this->materiaRelacionadaSenadoWsService = $materiaRelacionadaSenadoWsService;
	}

	public function store($proposicao) {
		$materiasRelacionadasSenado = array();

		if($proposicao->sg_casa_origem == 'SF') {
			$materiasRelacionadasSenado = $this->materiaRelacionadaSenadoWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_origem);
		}

		if($proposicao->sn_possui_revisora) {
			if($proposicao->sg_casa_revisora == 'SF') {
				$materiasRelacionadasSenado = $this->materiaRelacionadaSenadoWsService->findByProposicao($proposicao->id_proposicao, $proposicao->co_codigo_revisora);
			}
		}

		try {

			if ($materiasRelacionadasSenado){
				foreach ($materiasRelacionadasSenado as $materiaRelacionadaSenado) {
					$this->materiaRelacionadaRepository->firstOrCreate($materiaRelacionadaSenado);
				}
			}

		} catch(\Exception $e) {
			
			throw new \Exception('Erro ao realizar o cadastro de Materia Relacionada ('. $e->getMessage() .')');

		}
	}

}