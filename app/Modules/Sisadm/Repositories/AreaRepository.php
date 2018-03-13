<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\Area;

class AreaRepository extends AbstractRepository
{

	public function __construct(Area $model)
	{
		$this->model = $model;
	}

}