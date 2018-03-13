<?php
namespace App\Modules\Sismed\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sismed\Models\Servidor;
use MaskHelper;
use DB;

class ServidorRepository extends AbstractRepository
{

	public function __construct(Servidor $model)
	{
		$this->model = $model;
	}

	public function filterServidor(array $parametros)
	{
		
		$andCriteria = array();
		$andCriteria[] = ['id_servidor', '<>', '0'];

		if (isset($parametros['co_prontuario']) and ($parametros['co_prontuario'] != '')){
			$andCriteria[] = ['co_prontuario', '=', $parametros['co_prontuario']];
		}

		if (isset($parametros['nr_cpf']) and ($parametros['nr_cpf'] != '')){
			$andCriteria[] = ['nr_cpf', '=', MaskHelper::removeMascaraCpf($parametros['nr_cpf'])];
		}

		if (isset($parametros['nr_siape']) and ($parametros['nr_siape'] != '')){
			$andCriteria[] = ['nr_siape', '=', $parametros['nr_siape']];
		}

		if (isset($parametros['no_servidor']) and ($parametros['no_servidor'] != '')){
			$andCriteria[] = ['no_servidor', 'like', "%".$parametros['no_servidor']."%"];
		}

		$servidores = $this->findBy($andCriteria);
		return $servidores;
		
	}

	public function select($request)
	{
		
		$servidores = DB::table('spoa_portal_sismed.servidor')->select(['id_servidor','co_prontuario','nr_cpf', 'nr_siape', 'no_servidor', 'no_orgao']);

		return $servidores;


		
	}

}