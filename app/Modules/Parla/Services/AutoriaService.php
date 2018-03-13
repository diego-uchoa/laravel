<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\AutoriaRepository;
use Illuminate\Http\Request;
use Exception;
use DB;

class AutoriaService {
	protected $autoriaRepository;
	protected $autoriaSenadoWsService;
	protected $autoriaCamaraWsService;
	protected $parlamentarService;

	public function __construct(AutoriaRepository $autoriaRepository, AutoriaCamaraWsService $autoriaCamaraWsService, AutoriaSenadoWsService $autoriaSenadoWsService, ParlamentarService $parlamentarService) {
		$this->autoriaRepository = $autoriaRepository;
		$this->autoriaCamaraWsService = $autoriaCamaraWsService;
		$this->autoriaSenadoWsService = $autoriaSenadoWsService;
		$this->parlamentarService = $parlamentarService;
	}

	public function store($proposicao) {

		if($proposicao->sg_casa_origem == 'SF') {
			$autoria = $this->autoriaSenadoWsService->findAutorByProposicao($proposicao);
		}
		else if($proposicao->sg_casa_origem == 'CD') {
			$autoria = $this->autoriaCamaraWsService->findAutorByProposicao($proposicao);
		}

		try {

			if($autoria['in_tipo_autor'] == 'DEP' || $autoria['in_tipo_autor'] == 'SEN') {
				$id_parlamentar = $this->parlamentarService->store($autoria['co_codigo_parlamentar'], $autoria['in_tipo_autor'])->id_parlamentar;
			}
			else {
				$id_parlamentar = null;
			}

			$dadosAutoria = array(
				'id_proposicao' => $proposicao->id_proposicao,
				'id_parlamentar' => $id_parlamentar,
				'no_nome_autor' => $autoria['no_nome_autor'],
				'in_tipo_autor' => $autoria['in_tipo_autor'],
				'sg_partido_autor' => $autoria['sg_partido_autor'],
				'sg_uf_autor' => $autoria['sg_uf_autor'],
			);

			$this->autoriaRepository->firstOrCreate($dadosAutoria);

		} catch(\Exception $e) {
			
			throw new \Exception('Erro ao realizar o cadastro de Autoria ('. $e->getMessage() .')');

		}
	}

}