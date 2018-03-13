<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\Contratada;
use App\Repositories\AbstractRepository;

class ContratadaRepository extends AbstractRepository
{
    public function __construct(Contratada $model)
    {
        $this->model = $model;
    }

    /**
    * Recuperar todos os registros ativos das contratadas, ordenando-os pelo nome
    * @return Array Contratada
    */
    public function findAllOrderByName()
    {
        $contratadas = $this->findAll(['no_razao_social']);
        return $contratadas;
    }	

    /**
    * Recuperar todos os dados da Contratada pelo CNPJ
    * @return Array Contratada
    */
    public function findByCNPJ($cnpj)
    {   
        $contratada = $this->filterByAttribute('nr_cpf_cnpj', $cnpj);
        if (count($contratada) > 0){
            return $contratada[0];
        }else{
            $contratada = $this->findDeleted([['nr_cpf_cnpj', '=', $cnpj]]);
            if (count($contratada) > 0){
                $this->restoreDeleted([['nr_cpf_cnpj', '=', $cnpj]]);
                return $contratada[0];
            }else{
                return "";
            }
        }
    }    
}
