<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Repositories\UserRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;
use App\Modules\Sisadm\Repositories\AuditoriaRepository;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\UtilHelper;

class AuditoriaController extends Controller
{
    
    protected $repository;
    protected $usuarioRepository;
    protected $sistemaRepository;

    public function __construct(AuditoriaRepository $repository,UserRepository $usuarioRepository, SistemaRepository $sistemaRepository)
    {
        $this->repository = $repository;
        $this->usuarioRepository = $usuarioRepository;
        $this->sistemaRepository = $sistemaRepository;
    }

    public function search(Request $request)
    {
               
        $usuarios = $this->usuarioRepository->listsOpcional('no_usuario','id_usuario');
        $sistemas = $this->sistemaRepository->listsOpcional('no_sistema','no_sistema');

        $user_id = UtilHelper::getUsuario()->id_usuario;

        if (!empty($request->all())) {
            $fieldsSearch = $this->unsetCleanFields($request->all());
            $auditorias = $this->repository->searchWithRelations($fieldsSearch);            
        } else {
            $auditorias = $this->repository->getAllWithRelations();            
        }
              
        return view('sisadm::auditoria.search', compact('auditorias','usuarios','sistemas','user_id'));
    }

    /**
    *
    * Private Functions
    *
    */

    /**
    * Limpa campos vazios
    *
    * @param array $attributes
    * @return array
    */
    private function unsetCleanFields(array $attributes)
    {
       $data = [];
       foreach ($attributes as $key => $value) {
           if (!is_null($value)) {
               $data[$key] = $value;
           }
       }
       return $data;
    }
  
}