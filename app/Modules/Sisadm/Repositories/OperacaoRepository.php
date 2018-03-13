<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\Operacao;

use DB;

class OperacaoRepository extends AbstractRepository
{

	public function __construct(Operacao $model)
	{
		$this->model = $model;
	}

	public function filterByUsuario($username)
	{
		return  DB::table('operacao')
				->join('spoa_portal.perfil_operacao', 'operacao.id_operacao', '=', 'perfil_operacao.operacao_id_operacao')
	            ->join('spoa_portal.perfil', 'perfil_operacao.perfil_id_perfil', '=', 'perfil.id_perfil')
	            ->join('spoa_portal.usuario_perfil', 'perfil.id_perfil', '=', 'usuario_perfil.id_perfil')
	            ->join('spoa_portal.usuario', 'usuario_perfil.id_usuario', '=', 'usuario.id_usuario')
	            ->join('spoa_portal.sistema', 'operacao.id_sistema', '=', 'sistema.id_sistema')
	            ->where('usuario.nr_cpf', $username)
	            ->where('operacao.sn_favorita', true) 
	            ->select('operacao.id_operacao','operacao.ds_operacao','operacao.no_operacao','sistema.no_sistema')
	            ->get();	
	}

	/**
    * Recuperar todos os registros ativos das operacoes, ordenando-os pelo nome
    * @return Array Operacao
    */
    public function findAllOrderByName()
    {
        $operacoes = $this->findAll(['no_operacao']);

        return $operacoes;
    }	

}