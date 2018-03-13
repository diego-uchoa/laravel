<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\Apensado;
use DB;

class ApensadoRepository extends AbstractRepository {

	public function __construct(Apensado $model) {
		$this->model = $model;
	}
}