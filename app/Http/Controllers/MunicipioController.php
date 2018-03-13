<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\MunicipioRepository;

class MunicipioController extends Controller
{

    protected $municipioRepository;
    
    public function __construct(MunicipioRepository $municipioRepository)
    {
        $this->municipioRepository = $municipioRepository;
    }

    /**
    * Método responsável por recuperar todos os municipios da UF informada
    * @param  string $uf
    * @return Municipio
    */
    public function listMunicipiosByUf($uf)
    {
        
        return $this->municipioRepository->listsByAttribute('no_municipio','id_municipio','id_uf',$uf);

    }
}
