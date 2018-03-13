<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\Substitutivo;
use DB;

class SubstitutivoRepository extends AbstractRepository {

	public function __construct(Substitutivo $model) {
		$this->model = $model;
	}

	public function findByProposicao($idProposicao) {
		$substitutivos = Substitutivo::where([['id_proposicao','=',$idProposicao]])->get();

		return $substitutivos;
	}


}