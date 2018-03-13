<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\Perfil;

use Illuminate\Http\Request;

class PerfilRepository extends AbstractRepository
{

	public function __construct(Perfil $model)
	{
		$this->model = $model;
	}

    /**
    * Recuperar todos os registros ativos dos perfis, ordenando-os pelo Nome do Sistema
    * @return Array Perfil
    */
    public function findAllOrderByName()
    {
        $perfis = $this->findAll(['no_perfil']);

        return $perfis;
    }

    /**
    * Recupera perfil pelo nome
    * @param  String $nome do perfil
    * @return Perfil
    */
    public function findByName($nomePerfil)
    {
        $andCriteria[] = ['no_perfil', 'like', $nomePerfil];

        $perfil = $this->findBy($andCriteria);
        
        return $perfil->first();
    }   

    public function operacoesPerfil($id)
    {
        $perfil = $this->model->find($id);

        $operacoesPerfil = array();

        foreach ($perfil->operacoes as $operacao) {
            $operacoesPerfil[] = $operacao->id_operacao;
        }

        return $operacoesPerfil;
    }

	public function addOperacoes($perfil, $operacao)
    {
        return $perfil->operacoes()->save($operacao);
    }

    public function revokeOperacoes($perfil, $operacao)
    {
        return $perfil->operacoes()->detach($operacao);
    }

    public function syncOperacoes($perfil, $operacoes)
    {
        $operacoes = (array)$operacoes;
        return $perfil->operacoes()->sync($operacoes);
    }

}