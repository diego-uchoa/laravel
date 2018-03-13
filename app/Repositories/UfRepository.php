<?php
namespace App\Repositories;

use App\Models\Uf;

class UfRepository extends AbstractRepository
{

    protected $model;
        
    public function __construct(Uf $model)
    {
        $this->model = $model;
    }

}