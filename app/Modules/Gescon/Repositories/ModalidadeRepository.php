<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\Modalidade;
use App\Repositories\AbstractRepository;

class ModalidadeRepository extends AbstractRepository
{
    public function __construct(Modalidade $model)
    {
        $this->model = $model;
    }

    /**
    * Retorna as Modalidades em formato de array para popular um SELECT do tipo SELECT2
    */
    public function prepareListaSelect()
    {
        $listaModalidades = [];    
        
        $tipos = $this->findAll(['no_modalidade']);            
        foreach ($tipos as $tipo) {
            $listaModalidades[] = ['text' => $tipo->no_modalidade, 'id' => $tipo->id_modalidade];
        }    
        return $listaModalidades;        
    }    
}
