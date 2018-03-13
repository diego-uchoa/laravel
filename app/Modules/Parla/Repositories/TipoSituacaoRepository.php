<?php

namespace App\Modules\Parla\Repositories;

use App\Modules\Parla\Models\TipoSituacao;
use App\Repositories\AbstractRepository;

class TipoSituacaoRepository extends AbstractRepository
{
    public function __construct(TipoSituacao $model)
    {
        $this->model = $model;
    }
}
