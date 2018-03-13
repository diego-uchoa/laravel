<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\Edificio;
use App\Repositories\AbstractRepository;

class EdificioRepository extends AbstractRepository
{
    public function __construct(Edificio $model)
    {
        $this->model = $model;
    }

    /**
    * Retorna todos os Edificios por UF em formato de array para popular um SELECT do tipo SELECT2
    * @param  String $sg_uf
    */
    public function prepareListByUf($parametro, $sg_uf)
    {
        $listaEdificios = [];    
        
        $edificios = $this->findBy([['sg_uf', '=' , $sg_uf],['no_edificio', 'like', '%'.$parametro.'%']]);

        foreach ($edificios as $edificio) {
            $listaEdificios[$edificio->id_edificio] = $edificio->no_edificio;
        }
        
        return $listaEdificios;        
    }    
}
