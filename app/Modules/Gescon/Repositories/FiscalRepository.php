<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\Fiscal;
use App\Repositories\AbstractRepository;

class FiscalRepository extends AbstractRepository
{
    public function __construct(Fiscal $model)
    {
        $this->model = $model;
    }

    /**
    * Recuperar todos os registros ativos dos fiscais, ordenando-os pelo nome
    * @return Array Fiscal
    */
    public function findAllOrderByName()
    {
        $fiscais = $this->findAll(['no_fiscal']);
        return $fiscais;
    }	

    /**
    * Recuperar todos os dados do fiscal pelo CPF
    * @return Array Fiscal
    */
    public function findByCPF($cpf)
    {   
        $fiscal = $this->filterByAttribute('nr_cpf', $cpf);
        if (count($fiscal) > 0){
            return $fiscal[0];
        }else{
            return "";
        }
    }    
}
