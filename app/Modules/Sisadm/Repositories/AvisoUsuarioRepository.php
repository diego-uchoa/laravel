<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\AvisoUsuario;

use DB;

use Carbon\Carbon;

class AvisoUsuarioRepository extends AbstractRepository
{

	public function __construct(AvisoUsuario $model)
	{
		$this->model = $model;
	}

	/**
	 * Recuperar todos os registros ativos dos avisos de usuario, ordenando-os pelo nome
	 * @return Array AvisoUsuario
	 */
	public function findAllOrderByName()
	{
	        $avisos_usuario = $this->findAll(['tx_aviso_usuario']);

	        return $avisos_usuario;
	}   

	public function geraAvisoUsuario($username,$sistema)
	{
		return $this->model->query()
        ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_usuario.id_sistema') 
        ->join('spoa_portal.usuario', 'usuario.id_usuario', '=', 'aviso_usuario.id_usuario')
        ->join('spoa_portal.tipo_aviso_usuario', 'aviso_usuario.id_tipo_aviso_usuario', '=', 'tipo_aviso_usuario.id_tipo_aviso_usuario')
        ->where('usuario.nr_cpf', $username)
        ->where('sistema.no_sistema', $sistema)
        ->select('aviso_usuario.*','sistema.no_sistema','tipo_aviso_usuario.no_tipo_aviso_usuario')
        ->orderBy('sn_lido', 'asc')
        ->orderBy('nr_ordem', 'asc')
        ->get();       
	}

	public function geraAvisoUsuarioTodosSistemas($username)
	{
		return $this->model->query()
        ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_usuario.id_sistema') 
        ->join('spoa_portal.usuario', 'usuario.id_usuario', '=', 'aviso_usuario.id_usuario')
        ->join('spoa_portal.tipo_aviso_usuario', 'aviso_usuario.id_tipo_aviso_usuario', '=', 'tipo_aviso_usuario.id_tipo_aviso_usuario')
        ->where('usuario.nr_cpf', $username)
        ->select('aviso_usuario.*','sistema.no_sistema','tipo_aviso_usuario.no_tipo_aviso_usuario')
        ->orderBy('sn_lido', 'asc')
        ->orderBy('nr_ordem', 'asc')
        ->get();       
	}	

	public function marcaAvisosLidos($username)
	{

		return $this->model->query()
		->join('spoa_portal.usuario', 'usuario.id_usuario', '=', 'aviso_usuario.id_usuario')
		->where('usuario.nr_cpf', $username)
		->where('sn_lido', false)
		->update(['sn_lido' => true, 'dt_lido' => Carbon::now() ]);

	}

	public function qtdAvisosNaoLidos($username,$sistema)
	{
		return $this->model->query()
		->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_usuario.id_sistema')
		->join('spoa_portal.usuario', 'usuario.id_usuario', '=', 'aviso_usuario.id_usuario')
		->where('usuario.nr_cpf', $username)
		->where('sistema.no_sistema', $sistema)
		->where('sn_lido', false)
		->count();
	}

	public function geraAvisoUsuarioGeral($username)
	{
		return $this->model->query()
        ->join('spoa_portal.usuario', 'usuario.id_usuario', '=', 'aviso_usuario.id_usuario')
        ->join('spoa_portal.tipo_aviso_usuario', 'aviso_usuario.id_tipo_aviso_usuario', '=', 'tipo_aviso_usuario.id_tipo_aviso_usuario')
        ->where('usuario.nr_cpf', $username)
        ->whereNull('aviso_usuario.id_sistema')
        ->select('aviso_usuario.*','tipo_aviso_usuario.no_tipo_aviso_usuario')
        ->orderBy('sn_lido', 'asc')
        ->orderBy('nr_ordem', 'asc')
        ->get();            
	}

	public function qtdAvisosNaoLidosGeral($username)
	{
		return $this->model->query()
		->join('spoa_portal.usuario', 'usuario.id_usuario', '=', 'aviso_usuario.id_usuario')
		->where('usuario.nr_cpf', $username)
		->whereNull('aviso_usuario.id_sistema')
		->where('sn_lido', false)
		->count();
	}

}