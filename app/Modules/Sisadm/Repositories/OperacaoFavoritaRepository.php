<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\OperacaoFavorita;

class OperacaoFavoritaRepository extends AbstractRepository
{

	public function __construct(OperacaoFavorita $model)
	{
		$this->model = $model;
	}

	public function operacoesFavoritas($idUsuario)
	{
	    $operacoes = $this->model->where('id_usuario', $idUsuario)->get();

	    $operacoesFavoritas = array();

	    foreach ($operacoes as $operacao) {
	        $operacoesFavoritas[] = $operacao->id_operacao;
	    }

	    return $operacoesFavoritas;
	}


	public function deleteByUsuario($idUsuario)
	{
	    $this->model->where('id_usuario', $idUsuario)->delete();	    
	}

	public function geraMenuFavorito($username,$idSistema)
	{
		return $this->model->query()
				->join('spoa_portal.operacao','operacao_favorita.id_operacao','=','operacao.id_operacao')
				->join('spoa_portal.sistema','operacao.id_sistema','=','sistema.id_sistema')
                ->join('spoa_portal.perfil', 'sistema.id_sistema', '=', 'perfil.id_sistema')
                ->join('spoa_portal.usuario_perfil', 'perfil.id_perfil', '=', 'usuario_perfil.id_perfil')
                ->join('spoa_portal.usuario', 'usuario_perfil.id_usuario', '=', 'usuario.id_usuario')
                ->where('usuario.nr_cpf', '=', $username)
                ->where('sistema.id_sistema','=',$idSistema)
                ->select('operacao.no_operacao','operacao.ds_operacao')                                
                ->get();
	}

	public function contaMenuFavorito($username)
	{
		return $this->model->query()
				->join('spoa_portal.operacao','operacao_favorita.id_operacao','=','operacao.id_operacao')
				->join('spoa_portal.sistema','operacao.id_sistema','=','sistema.id_sistema')
                ->join('spoa_portal.perfil', 'sistema.id_sistema', '=', 'perfil.id_sistema')
                ->join('spoa_portal.usuario_perfil', 'perfil.id_perfil', '=', 'usuario_perfil.id_perfil')
                ->join('spoa_portal.usuario', 'usuario_perfil.id_usuario', '=', 'usuario.id_usuario')
                ->where('usuario.nr_cpf', '=', $username)                                                              
                ->count();
	}		

}