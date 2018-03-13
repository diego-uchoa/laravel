<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\Autoria;
use DB;

class AutoriaRepository extends AbstractRepository {

	public function __construct(Autoria $model) {
		$this->model = $model;
	}

	public function findByProposicao($idProposicao) {
		$emendas = Autoria::where([['id_proposicao','=',$idProposicao]])->get();

		return $emendas;
	}


}