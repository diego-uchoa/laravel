<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\TipoAvisoUsuario;

class TipoAvisoUsuarioRepository extends AbstractRepository
{

	public function __construct(TipoAvisoUsuario $model)
	{
		$this->model = $model;
	}

}