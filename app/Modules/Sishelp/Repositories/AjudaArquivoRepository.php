<?php
namespace App\Modules\Sishelp\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sishelp\Models\AjudaArquivo;

class AjudaArquivoRepository extends AbstractRepository
{

	public function __construct(AjudaArquivo $model)
	{
		$this->model = $model;
	}


	public function filterBySistema($sistema)
	{
		return $this->filterByAttribute('id_sistema', $sistema->id_sistema);		
	}
	
}