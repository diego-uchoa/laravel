<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\ContratoPreposto;
use App\Repositories\AbstractRepository;

class ContratoPrepostoRepository extends AbstractRepository
{
    public function __construct(ContratoPreposto $model)
    {
        $this->model = $model;
    }

}
