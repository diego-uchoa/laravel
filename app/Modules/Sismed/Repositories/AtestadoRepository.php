<?php
namespace App\Modules\Sismed\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sismed\Models\Atestado;
use Carbon\Carbon;


class AtestadoRepository extends AbstractRepository
{

	public function __construct(Atestado $model)
	{
		$this->model = $model;
	}

	public function filterByIdServidor($id)
	{
		
		$andCriteria = array();
		$andCriteria[] = ['id_servidor', '=', $id];
		
		$atestados = $this->findBy($andCriteria);

		return $atestados;
		
	}

	public function filterByAno($ano)
	{
		
		$atestados = $this->model->whereYear('created_at', '=', $ano)->get();

		return $atestados;
		
	}

	public function filterAtestado(array $parametros)
	{	
		$andCriteria = array();

		if (isset($parametros['dt_inicio_cadastro']) and ($parametros['dt_inicio_cadastro'] != '')){
			$andCriteria[] = ['created_at', '>=', Carbon::createFromFormat('d/m/Y', $parametros['dt_inicio_cadastro'])->toDateString()];
		}

		if (isset($parametros['dt_fim_cadastro']) and ($parametros['dt_fim_cadastro'] != '')){
			$andCriteria[] = ['created_at', '<=', Carbon::createFromFormat('d/m/Y', $parametros['dt_fim_cadastro'])->toDateString()];
		}

		if (isset($parametros['in_area_atendimento']) and ($parametros['in_area_atendimento'] != '')){
			$andCriteria[] = ['in_area_atendimento', '=', $parametros['in_area_atendimento']];
		}

		if (isset($parametros['in_tipo_afastamento']) and ($parametros['in_tipo_afastamento'] != '')){
			$andCriteria[] = ['in_tipo_afastamento', '=', $parametros['in_tipo_afastamento']];
		}

		if (isset($parametros['in_tipo_pericia']) and ($parametros['in_tipo_pericia'] != '')){
			$andCriteria[] = ['in_tipo_pericia', '=', $parametros['in_tipo_pericia']];
		}

		if (isset($parametros['in_situacao']) and ($parametros['in_situacao'] != '')){
			$andCriteria[] = ['in_situacao', '=', $parametros['in_situacao']];
		}

		if (isset($parametros['dt_inicio_afastamento_inicial']) and ($parametros['dt_inicio_afastamento_inicial'] != '')){
			$andCriteria[] = ['dt_inicio_afastamento', '=', $parametros['dt_inicio_afastamento_inicial']];
		}

		if (isset($parametros['dt_fim_afastamento_inicial']) and ($parametros['dt_fim_afastamento_inicial'] != '')){
			$andCriteria[] = ['dt_fim_afastamento', '=', $parametros['dt_fim_afastamento_inicial']];
		}

		if(empty($andCriteria)){
			$atestados = $this->all();
		}
		else {
			$atestados = $this->findBy($andCriteria);
		}

		return $atestados;
		
	}

	public static function verificaCadastroDataInicio($idServidor, $dataInicioAfastamento){

	    $ultimoAtestado = Atestado::where('id_servidor',$idServidor)->orderBy('dt_inicio_afastamento', 'desc')->first();

	    if($ultimoAtestado){
	    	$dataInicioAfastamento = Carbon::createFromFormat('d/m/Y', $dataInicioAfastamento)->toDateString();
	    	$ultimoAtestadoInicioAfastamento = Carbon::createFromFormat('d/m/Y', $ultimoAtestado->dt_inicio_afastamento)->toDateString();	    	

	    	if($dataInicioAfastamento < $ultimoAtestadoInicioAfastamento){
	    	    return false;
	    	}
	    	else{
	    	    return true;
	    	}	
	    }else{
	    	return true;
	    }
	    
	}

	
	public function select($request)
	{
		 
		$atestados = $this->model->select(['id_atestado','in_area_atendimento','in_tipo_afastamento','in_tipo_pericia','nr_crm','te_prazo','dt_inicio_afastamento','dt_fim_afastamento','in_situacao','tx_observacao','atestado.id_servidor'])->with('servidor');
		return $atestados;
		
	}

}