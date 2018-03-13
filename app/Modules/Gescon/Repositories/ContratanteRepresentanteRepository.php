<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\ContratanteRepresentante;
use App\Repositories\AbstractRepository;

class ContratanteRepresentanteRepository extends AbstractRepository
{
    public function __construct(ContratanteRepresentante $model)
    {
        $this->model = $model;
    }
}
