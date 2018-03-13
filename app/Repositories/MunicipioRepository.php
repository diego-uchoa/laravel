<?php
namespace App\Repositories;

use App\Models\Municipio;

class MunicipioRepository extends AbstractRepository
{

    protected $model;
        
    public function __construct(Municipio $model)
    {
        $this->model = $model;
    }

    /**
    * Recupera o Municipio do BD
    * @param  string $co_municipio_siorg
    * @return Municipio
    */
    public function findByCodigoSiorg($co_municipio_siorg)
    {
        $municipio = $this->findBy([['co_municipio_siorg', '=' , $co_municipio_siorg]]);

        return $municipio;
    }    

    public function preparaListaMunicipio($id_uf) {
        $listaMunicipios  = array();

        $ufs = $this->findAllOrderBy(array(['sg_uf','asc']));

        $listaMunicipios[null] = 'Selecione ...';

        foreach ($ufs as $uf) {
            $listaMunicipios[$uf->id_uf] = $uf->sg_uf;
        }

        return $listaMunicipios;        
    }

}