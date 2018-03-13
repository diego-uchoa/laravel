<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\UnidadeMedidaItemContratacao;
use App\Repositories\AbstractRepository;

class UnidadeMedidaItemContratacaoRepository extends AbstractRepository
{
    public function __construct(UnidadeMedidaItemContratacao $model)
    {
        $this->model = $model;
    }

    /**
    * Recuperar todos os registros ativos das unidade de medida de itens de contratação, ordenando-os pelo Objeto
    * @return Array UnidadeMedidaItemContratacao
    */
    public function findAllOrderByObjeto()
    {
        $unidades = $this->findAll(['in_objeto']);
        return $unidades;
    }	
}
