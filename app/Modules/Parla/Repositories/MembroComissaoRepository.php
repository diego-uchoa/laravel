<?php

namespace App\Modules\Parla\Repositories;

use App\Modules\Parla\Models\MembroComissao;
use App\Repositories\AbstractRepository;

class MembroComissaoRepository extends AbstractRepository
{
    public function __construct(MembroComissao $model)
    {
        $this->model = $model;
    }

    public function syncMembros($comissao, $membros)
    {
        return $comissao->membros()->sync($membros);
    }
}
