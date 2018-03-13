<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\Sistema;

use DB;

class SistemaRepository extends AbstractRepository
{

	public function __construct(Sistema $model)
	{
		$this->model = $model;
	}

	public function findByNome($nomeSistema)
	{
		return $this->findByAttribute('no_sistema', $nomeSistema);		
	}

	/**
    * Recuperar todos os registros ativos dos sistemas, ordenando-os pelo nome
    * @return Array Sistema
    */
    public function findAllOrderByName()
    {
        $sistemas = $this->findAll(['no_sistema']);

        return $sistemas;
    }	

	/**
	* Busca nome do sistema por id
	* @param  id do sistema
	* @return nome do sistema
	*/
	public function getNomeSistemaById($id)
	{
	    $sistema = $this->find($id);

	    return $sistema->no_sistema;
	}

	public function geraMenuSistema($username)
	{

		return $this->model->query()
                    ->join('spoa_portal.perfil', 'sistema.id_sistema', '=', 'perfil.id_sistema')
                    ->join('spoa_portal.usuario_perfil', 'perfil.id_perfil', '=', 'usuario_perfil.id_perfil')
                    ->join('spoa_portal.usuario', 'usuario_perfil.id_usuario', '=', 'usuario.id_usuario')
                    ->where('usuario.nr_cpf', '=', $username)
                    ->select('sistema.*')
                    ->distinct()
                    ->orderBy('nr_ordem', 'asc')
                    ->get();

	}

	public function listsByUsuario($username)
	{
		return $this->model->query()
                    ->join('perfil', 'sistema.id_sistema', '=', 'perfil.id_sistema')
                    ->join('usuario_perfil', 'perfil.id_perfil', '=', 'usuario_perfil.id_perfil')
                    ->join('usuario', 'usuario_perfil.id_usuario', '=', 'usuario.id_usuario')
                    ->where('usuario.nr_cpf', '=', $username)
                    ->select('sistema.*')
                    ->distinct()
                    ->orderBy('nr_ordem', 'asc')
                    ->get()->pluck('no_sistema','id_sistema');
	}

	/**
	* Busca os orgaos utilizados por um sistema
	* @param  id do sistema
	* @return nome do sistema
	*/
	public function getOrgaosBySistema($id_sistema)
	{
		return DB::table('spoa_portal.orgao_sistema')
		   		->join('spoa_portal.orgao', 'orgao_sistema.id_orgao', '=', 'orgao.id_orgao')
		   		->where('orgao_sistema.id_sistema','=',$id_sistema) 
	    		->get();
	}

	public function deleteOrgaoBySistema($id_sistema,$id_orgao)
	{
		return DB::table('spoa_portal.orgao_sistema')
		   		->where('orgao_sistema.id_sistema','=',$id_sistema) 
		   		->where('orgao_sistema.id_orgao','=',$id_orgao) 
	    		->delete();
	}

	public function setOrgaoBySistema($id_sistema,$id_orgao)
	{
	    return DB::insert('insert into spoa_portal.orgao_sistema (id_sistema, id_orgao) values (?, ?)', [$id_sistema, $id_orgao]);
	}


}