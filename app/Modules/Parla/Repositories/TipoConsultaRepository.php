<?php

namespace App\Modules\Parla\Repositories;

use App\Modules\Parla\Models\TipoConsulta;
use App\Repositories\AbstractRepository;

class TipoConsultaRepository extends AbstractRepository
{
    public function __construct(TipoConsulta $model)
    {
        $this->model = $model;
    }

    public function preparaListaTiposConsulta() {
    	$listaTiposConsulta  = array();

    	$tiposConsulta = $this->all();

        $listaTiposConsulta[null] = 'Selecione ...';

    	foreach ($tiposConsulta as $tipo) {
    		$listaTiposConsulta[$tipo->id_tipo_consulta] = $tipo->tx_tipo_consulta;
    	}

    	return $listaTiposConsulta;        
    }
}
