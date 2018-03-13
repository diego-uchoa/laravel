<?php
namespace App\Modules\Sishelp\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sishelp\Models\AjudaGeral;

class AjudaGeralRepository extends AbstractRepository
{

	public function __construct(AjudaGeral $model)
	{
		$this->model = $model;
	}

	public function findBySistema($sistema)
	{
		return $this->findByAttribute('id_sistema', $sistema->id_sistema);		
	}

}