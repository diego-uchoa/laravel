<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\ParlamentarRepository;
use App\Modules\Parla\Repositories\FiliacaoPartidariaRepository;
use Illuminate\Support\Collection;
use Exception;

class ParlamentarService
{
	protected $parlamentarRepository;
	protected $filiacaoPartidariaRepository;
	protected $parlamentarCamaraWsService;
	protected $parlamentarSenadoWsService;
	const COMPLEMENTO_WSDL = 'Deputados';

	public function __construct(ParlamentarRepository $parlamentarRepository, 
									FiliacaoPartidariaRepository $filiacaoPartidariaRepository,
									ParlamentarCamaraWsService $parlamentarCamaraWsService,
									ParlamentarSenadoWsService $parlamentarSenadoWsService)
	{
		$this->parlamentarRepository = $parlamentarRepository;
		$this->filiacaoPartidariaRepository = $filiacaoPartidariaRepository;
		$this->parlamentarCamaraWsService = $parlamentarCamaraWsService;
		$this->parlamentarSenadoWsService = $parlamentarSenadoWsService;
	}


	/**
	* Gravar dados do Parlamentar na BD
	* @param integer idParlamentar
	* @param string inParlamentar
	* @return Parlamentar
	*/	
	public function store($idParlamentar, $inParlamentar)
	{

		try{

				if ($inParlamentar == 'DEP'){

					$dadosParlamentarWS = $this->parlamentarCamaraWsService->findParlamentarById($idParlamentar);
				}else{

					$dadosParlamentarWS = $this->parlamentarSenadoWsService->findParlamentarById($idParlamentar);

				}

				if ($dadosParlamentarWS){
					
					$parlamentar = $this->parlamentarRepository->store($dadosParlamentarWS[0]['dadosParlamentar']);
					$filiacaoPartidaria = $this->filiacaoPartidariaRepository->store($parlamentar->id_parlamentar, $dadosParlamentarWS[1]['dadosFiliacaoPartidaria']);
					return $parlamentar;

				}		

				return null;

		}catch (Exception $e){
			throw new Exception($e->getMessage(), $e->getCode());

		}

	}
	
}