<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\TipoAvisoSistema;

class TipoAvisoSistemaRepository extends AbstractRepository
{

	public function __construct(TipoAvisoSistema $model)
	{
		$this->model = $model;
	}

}