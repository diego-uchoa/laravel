<?php
namespace App\Modules\Sismed\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sismed\Models\ControleCiclo;

class ControleCicloRepository extends AbstractRepository
{

	public function __construct(ControleCiclo $model)
	{
		$this->model = $model;
	}

	public function filterByIdServidor($id)
	{
		
		$andCriteria = array();
		$andCriteria[] = ['id_servidor', '=', $id];
		$orderBy[] = ['dt_inicio_ciclo', 'DESC'];
		
		$controleCiclos = $this->findBy($andCriteria,null,$orderBy,null,null);

		return $controleCiclos;
		
	}

	public function filterByIdServidorData($id,$data)
	{
		
		$andCriteria = array();
		$andCriteria[] = ['id_servidor', '=', $id];
		$andCriteria[] = ['dt_inicio_ciclo', '<=', $data];
		$andCriteria[] = ['dt_fim_ciclo', '>=', $data];
		$orderBy[] = ['id_controle_ciclo', 'DESC'];
		
		$controleCiclo = $this->findBy($andCriteria,null,$orderBy,null,null);

		return $controleCiclo;
		
	}

	public function filterByAtestadoOrigem($id)
	{
		
		$andCriteria = array();
		$andCriteria[] = ['id_atestado_origem', '=', $id];
		$orderBy[] = ['dt_inicio_ciclo', 'DESC'];
		
		$controleCiclo = $this->findBy($andCriteria,null,$orderBy,null,null);

		return $controleCiclo->first();
		
	}

	public function filterCanceladosByIdServidor($id)
	{
		 
		$ciclos = $this->model->where('id_servidor','=',$id)
		->onlyTrashed()
		->get();
		
		return $ciclos;
		
	}
	


}