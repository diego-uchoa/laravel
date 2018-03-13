<?php
namespace App\Modules\Sisfone\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisfone\Models\Telefone;

class TelefoneRepository extends AbstractRepository
{

	public function __construct(Telefone $model)
	{
		$this->model = $model;
	}

}