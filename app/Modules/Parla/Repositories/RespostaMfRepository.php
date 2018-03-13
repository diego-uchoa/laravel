<?php

namespace App\Modules\Parla\Repositories;

use App\Modules\Parla\Models\RespostaMf;
use App\Repositories\AbstractRepository;

class RespostaMfRepository extends AbstractRepository
{
    public function __construct(RespostaMf $model)
    {
        $this->model = $model;
    }
}
