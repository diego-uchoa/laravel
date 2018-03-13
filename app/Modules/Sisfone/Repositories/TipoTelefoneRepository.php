<?php
namespace App\Modules\Sisfone\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisfone\Models\TipoTelefone;

class TipoTelefoneRepository extends AbstractRepository
{

	public function __construct(TipoTelefone $model)
	{
		$this->model = $model;
	}

}