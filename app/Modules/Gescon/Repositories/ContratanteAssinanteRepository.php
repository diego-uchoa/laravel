<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\ContratanteAssinante;
use App\Repositories\AbstractRepository;

class ContratanteAssinanteRepository extends AbstractRepository
{
    public function __construct(ContratanteAssinante $model)
    {
        $this->model = $model;
    }

    /**
    * Verifica se já existe um cadastro com os dados do Assinante Ativo
    * @return Boolean 
    */
    public function findAssinanteByContratante($nr_cpf_assinante, $id_contratante)
    {
        $contrato = $this->findBy([['nr_cpf_assinante','=', $nr_cpf_assinante],['id_contratante', '=', $id_contratante]]);
        if (count($contrato) > 0){
        	return true;
        }
        return false;
    }   

}
