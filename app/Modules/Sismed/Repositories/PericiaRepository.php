<?php
namespace App\Modules\Sismed\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sismed\Models\Pericia;
use Carbon\Carbon;


class PericiaRepository extends AbstractRepository
{

	public function __construct(Pericia $model)
	{
		$this->model = $model;
	}

	public function filterByIdAtestado($id)
	{
		
		$andCriteria = array();
		$andCriteria[] = ['id_atestado', '=', $id];
		
		$pericias = $this->findBy($andCriteria);

		return $pericias;
		
	}


}