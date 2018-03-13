<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\ContratanteUsuario;
use App\Repositories\AbstractRepository;

class ContratanteUsuarioRepository extends AbstractRepository
{
    public function __construct(ContratanteUsuario $model)
    {
        $this->model = $model;
    }

    public function listUasgByUsuario($id_usuario)
    {
    	$listaUasg = [];
    	$contratantesUsuario = $this->findBy([['id_usuario','=', $id_usuario]]);
        if (count($contratantesUsuario) > 1){
            $listaUasg[null] = 'SELECIONE';
        }

    	foreach ($contratantesUsuario as $contratanteUsuario) {
    		$listaUasg[$contratanteUsuario->contratante->orgao->co_siafi] = $contratanteUsuario->contratante->orgao->co_siafi;
    	}
    	return $listaUasg;
    }
}
