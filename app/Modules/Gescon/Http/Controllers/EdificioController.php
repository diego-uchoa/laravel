<?php

namespace App\Modules\Gescon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Modules\Gescon\Repositories\EdificioRepository;

class EdificioController extends Controller
{
    /** @var  OrgaoRepository */
    private $edificioRepository;

    public function __construct(EdificioRepository $edificioRepository)
    {
        $this->edificioRepository = $edificioRepository;
    }

    /**
     * Método responsável por listar todos os Edificios
     * 
     * @return Json
     */
    public function listEdificiosByUf($sg_uf, Request $request)
    {
        $listaOrgaos = $this->edificioRepository->prepareListByUf($request["parametro"], $sg_uf);
        return $listaOrgaos;
    }   

}