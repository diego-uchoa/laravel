<?php
namespace App\Modules\Sishelp\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sishelp\Models\AjudaFaq;

class AjudaFaqRepository extends AbstractRepository
{

	public function __construct(AjudaFaq $model)
	{
		$this->model = $model;
	}

	public function filterBySistema($sistema)
	{
		return $this->filterByAttribute('id_sistema', $sistema->id_sistema);		
	}

}