<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\ContratoFiscal;
use App\Repositories\AbstractRepository;

class ContratoFiscalRepository extends AbstractRepository
{
    public function __construct(ContratoFiscal $model)
    {
        $this->model = $model;
    }

}
