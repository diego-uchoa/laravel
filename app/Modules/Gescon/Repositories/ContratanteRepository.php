<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\Contratante;
use App\Repositories\AbstractRepository;

class ContratanteRepository extends AbstractRepository
{
    public function __construct(Contratante $model)
    {
        $this->model = $model;
    }

    public function findByUasg($co_uasg)
    {
    	$contratante = $this->model->whereHas('orgao', function($query) use($co_uasg) {
    	    $query->where('co_siafi', $co_uasg);
    	})->with('orgao', 'representante', 'contratanteAssinantes', 'orgao.municipio', 'orgao.municipio.uf')->first();
    	
    	return $contratante;
    }

    public function orgaosList()
    {
        $retorno = [];
        $contratantes = $this->model->all();
        foreach ($contratantes as $contratante) {
            $orgao = $contratante->orgao;
            $retorno[$orgao->id_orgao] = $orgao->sg_orgao;
        }
        return $retorno;
    }
}
