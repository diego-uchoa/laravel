<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\Inconsistencia;

use DB;

class InconsistenciaRepository extends AbstractRepository
{

	public function __construct(Inconsistencia $model)
	{
		$this->model = $model;
	}

	public function limpaInconsistencias()
	{
		return $this->model->query()->delete();
	}

	public function verificaInconsistencias()
	{
		DB::select('SELECT spoa_portal."verifica"()');
	}

}