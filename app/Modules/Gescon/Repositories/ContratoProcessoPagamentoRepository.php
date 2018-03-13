<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\ContratoProcessoPagamento;
use App\Repositories\AbstractRepository;

class ContratoProcessoPagamentoRepository extends AbstractRepository
{
    public function __construct(ContratoProcessoPagamento $model)
    {
        $this->model = $model;
    }
}
