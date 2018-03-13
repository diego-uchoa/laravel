<?php
namespace App\Modules\Sisadm\Services;

use App\Modules\Sisadm\Repositories\PerfilRepository;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;


class PerfilService
{

	protected $repository;

	public function __construct(PerfilRepository $repository)
	{
		$this->repository = $repository;
	}

	public function getItensMenu($id)
	{

	    $perfil = $this->repository->find($id);

	    $itensMenu = new Collection;

	    foreach ($perfil->operacoes as $operacaoPerfil){

	        foreach ($operacaoPerfil->itensMenu as $item) {

	            $itensMenu->push($item);
	            
	        }

	    }
	    return $itensMenu->unique()->sortBy('id_item_menu_precedente');
	}
}


?>