<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\MateriaRelacionada;
use DB;

class MateriaRelacionadaRepository extends AbstractRepository {

	public function __construct(MateriaRelacionada $model) {
		$this->model = $model;
	}

}