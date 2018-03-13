<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\Auditoria;
use DB;
use Carbon\Carbon;

class AuditoriaRepository extends AbstractRepository
{

	public function __construct(Auditoria $model)
	{
		$this->model = $model;
	}


	public function searchWithRelations(array $attributes, $columns = ['*'])
	{
	    $query = $this->model->query()->with(['usuario']);

   		if (isset($attributes['id_usuario']) and ($attributes['id_usuario'] != ''))
	    	$query = $query->where('user_id', $attributes['id_usuario']);

   		if (isset($attributes['no_sistema']) and ($attributes['no_sistema'] != ''))
	    	$query = $query->where('url', 'like', '%'. strtoupper($attributes['no_sistema']) .'%');

	    if (isset($attributes['dt_inicio']) and ($attributes['dt_inicio'] != ''))
	    	$query = $query->where('created_at', '>=', Carbon::createFromFormat('d/m/Y', $attributes['dt_inicio'])->format('Y-m-d'));

	    if (isset($attributes['dt_fim']) and ($attributes['dt_fim'] != ''))
	    	$query = $query->where('created_at', '<=', Carbon::createFromFormat('d/m/Y', $attributes['dt_fim'])->format('Y-m-d'));
	    
	    $query = $query->orderBy('created_at', 'asc');

	    $auditorias = $query->paginate(5, $columns);    
    
	    return $auditorias;
	}

	public function getAllWithRelations($columns = ['*'])
	{
	    $auditorias = $this->model->query()
	    	->with(['usuario'])
            ->orderBy('audits.created_at', 'desc')
            ->paginate(5, $columns);

        return $auditorias;	    
	}

}