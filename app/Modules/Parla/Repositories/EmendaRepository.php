<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\Emenda;
use DB;

class EmendaRepository extends AbstractRepository {

	public function __construct(Emenda $model) {
		$this->model = $model;
	}

	public function findByProposicao($idProposicao) {
		$emendas = Emenda::where([['id_proposicao','=',$idProposicao]])->get();

		return $emendas;
	}


}