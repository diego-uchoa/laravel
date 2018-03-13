<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\ContratoItemContratacaoTerceirizacao;
use App\Repositories\AbstractRepository;

class ContratoItemContratacaoTerceirizacaoRepository extends AbstractRepository
{
    public function __construct(ContratoItemContratacaoTerceirizacao $model)
    {
        $this->model = $model;
    }
}
