<?php
namespace App\Modules\Sismed\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sismed\Models\ControleProntuario;

class ControleProntuarioRepository extends AbstractRepository
{

	public function __construct(ControleProntuario $model)
	{
		$this->model = $model;
	}

	public function findByLetraProntuario($letra)
	{
		return $this->findByAttribute('in_letra_prontuario',$letra);
	}

}