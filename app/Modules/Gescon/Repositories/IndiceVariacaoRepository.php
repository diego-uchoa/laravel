<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\IndiceVariacao;
use App\Repositories\AbstractRepository;

class IndiceVariacaoRepository extends AbstractRepository
{
    public function __construct(IndiceVariacao $model)
    {
        $this->model = $model;
    }
}
