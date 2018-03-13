<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\User;
use Adldap\Laravel\Facades\Adldap;
use MaskHelper;
use DB;
use DateTime;

class UserRepository extends AbstractRepository
{

	public function __construct(User $model)
	{
		$this->model = $model;
	}

    /**
    * Recuperar todos os registros ativos dos usuários externos, ordenando-os pelo nome
    * @return Array User
    */
    public function findExternoOrderByName()
    {
        $usuarios = $this->findAll(['no_usuario'])->where('sn_externo',true);

        return $usuarios;
    }

    /**
    * Recuperar todos os registros ativos dos usuários, ordenando-os pelo nome
    * @return Array User
    */
    public function findAllOrderByName()
    {
        $usuarios = $this->findAll(['no_usuario']);

        return $usuarios;
    }	

    /**
    * Recuperar dados do usuário no LDAP
    * @param  cpf do usuário
    * @return JSON
    */
    public function findByCpf_LDAP($cpf)
    {
    	$cpf_sem_mascara = MaskHelper::removeMascaraCpf($cpf);
    	$usuario = Adldap::search()->where('uid', '=', $cpf_sem_mascara)->get();
	    
        return $usuario;
    }

    /**
    * Verifica se o usuário existe no BD
    * @param  cpf do usuário
    * @return boolean (1 ou 0)
    */
    public function findByCpf($cpf)
    {
    	$cpf_sem_mascara = MaskHelper::removeMascaraCpf($cpf);
    	$usuario = $this->findBy([['nr_cpf', '=' , $cpf_sem_mascara]]);

        return $usuario;
    }

    /**
    * Reativa o usuário excluído logicamente
    * @param  cpf do usuário
    * @return boolean (1 ou 0)
    */
    public function restoreUserDeletedByCpf($cpf)
    {
        $cpf_sem_mascara = MaskHelper::removeMascaraCpf($cpf);
        $usuario = $this->restore([['nr_cpf', '=' , $cpf_sem_mascara]]);
        
        return $usuario;
    }


    /**
    * Retorna o usuário que esteja excluído logicamente
    * @param  cpf do usuário
    * @return User
    */
    public function findDeletedByCpf($cpf)
    {
        $cpf_sem_mascara = MaskHelper::removeMascaraCpf($cpf);
        $usuario = $this->findDeleted([['nr_cpf', '=' , $cpf_sem_mascara]]);

        return $usuario;
    }

    /**
    * Busca CPF de Usuário por ID
    * @param  id do usuário
    * @return CPF
    */
    public function getCpfById($id)
    {
        $usuario = $this->find($id);

        $cpf_sem_mascara = MaskHelper::removeMascaraCpf($usuario->nr_cpf);

        return $cpf_sem_mascara;
    }


    public function getListaAniversariosAno()
    {
        $dataInicio = (new DateTime('now'))->modify('-1 year');
        $dataFim =  (new DateTime('now'))->modify('+1 year');

        return DB::select("select usuario.*, to_char(siape_dado_pessoal.dt_nascimento, 'dd/mm/') || Extract (Year from now()) as dt_nascimento
                            from spoa_portal.usuario inner join spoa_portal.siape_dado_pessoal on siape_dado_pessoal.nr_cpf = usuario.nr_cpf 
                            where spoa_portal.usuario.deleted_at is null");

        /*return $this->model->query()
            ->join('spoa_portal.siape_dado_pessoal', 'siape_dado_pessoal.nr_cpf', '=', 'usuario.nr_cpf')
            ->select('usuario.*', 'to_char(siape_dado_pessoal.dt_nascimento, \'dd/mm\') || \'/\' || Extract (Year from now()) as dt_nascimento')
            ->where('dt_nascimento', '>=', $dataInicio)
            ->where('dt_nascimento', '<=', $dataFim)
            ->get();
        */
    }

    public function syncPerfis($usuario, $perfis)
    {
        $perfis = (array)$perfis;
        return $usuario->perfis()->sync($perfis);
    }

}