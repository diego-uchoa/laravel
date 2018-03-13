<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\ContratoInformacaoAdicional;
use App\Repositories\AbstractRepository;

class ContratoInformacaoAdicionalRepository extends AbstractRepository
{
    public function __construct(ContratoInformacaoAdicional $model)
    {
        $this->model = $model;
    }
}
