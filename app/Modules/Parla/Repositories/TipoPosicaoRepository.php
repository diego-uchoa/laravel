<?php

namespace App\Modules\Parla\Repositories;

use App\Modules\Parla\Models\TipoPosicao;
use App\Repositories\AbstractRepository;

class TipoPosicaoRepository extends AbstractRepository
{
    public function __construct(TipoPosicao $model)
    {
        $this->model = $model;
    }

    public function preparaListaTiposPosicao() {
    	$listaTiposPosicao  = array();

    	$tiposPosicao = $this->all();

    	$listaTiposPosicao[null] = 'Selecione ...';

    	foreach ($tiposPosicao as $tipo) {
    		$listaTiposPosicao[$tipo->id_tipo_posicao] = $tipo->tx_tipo_posicao;
    	}

    	return $listaTiposPosicao;        
    }
}
