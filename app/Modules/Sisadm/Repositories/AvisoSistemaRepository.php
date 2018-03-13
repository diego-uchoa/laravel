<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\AvisoSistema;

use DB;

class AvisoSistemaRepository extends AbstractRepository
{

	public function __construct(AvisoSistema $model)
	{
		$this->model = $model;
	}

    /**
     * Recuperar todos os registros ativos dos avisos de sistema, ordenando-os pelo nome
     * @return Array AvisoSistema
     */
    public function findAllOrderByName()
    {
            $avisos_sistema = $this->findAll(['tx_aviso_sistema']);

            return $avisos_sistema;
    }   

	public function geraAvisoSistema($sistema)
	{

        	return $this->model->query() 
                ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_sistema.id_sistema')
                ->join('spoa_portal.tipo_aviso_sistema', 'aviso_sistema.id_tipo_aviso_sistema', '=', 'tipo_aviso_sistema.id_tipo_aviso_sistema')
                ->select('aviso_sistema.*', 'sistema.no_sistema', 'tipo_aviso_sistema.no_tipo_aviso_sistema')
                ->where('sistema.no_sistema', $sistema)
                ->orderBy('nr_ordem', 'asc')
                ->get();

	}

        public function geraAvisoSistemaTodosSistemas()
        {

                return $this->model->query() 
                ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_sistema.id_sistema')
                ->join('spoa_portal.tipo_aviso_sistema', 'aviso_sistema.id_tipo_aviso_sistema', '=', 'tipo_aviso_sistema.id_tipo_aviso_sistema')
                ->select('aviso_sistema.*', 'sistema.no_sistema', 'tipo_aviso_sistema.no_tipo_aviso_sistema')
                ->orderBy('nr_ordem', 'asc')
                ->get();

        }

	public function geraAvisoSistemaDestaque($sistema)
	{

		return $this->model->query() 
                ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_sistema.id_sistema')
                ->join('spoa_portal.tipo_aviso_sistema', 'aviso_sistema.id_tipo_aviso_sistema', '=', 'tipo_aviso_sistema.id_tipo_aviso_sistema')
                ->select('aviso_sistema.*', 'sistema.no_sistema', 'tipo_aviso_sistema.no_tipo_aviso_sistema')
                ->where('sistema.no_sistema', $sistema)
                ->where('aviso_sistema.sn_destaque', true)
                ->orderBy('nr_ordem', 'asc')
                ->get();

	}

	public function qtdAvisoSistemaDestaque($sistema)
	{
		return $this->model->query() 
                ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_sistema.id_sistema')
                ->join('spoa_portal.tipo_aviso_sistema', 'aviso_sistema.id_tipo_aviso_sistema', '=', 'tipo_aviso_sistema.id_tipo_aviso_sistema')
                ->select('aviso_sistema.*', 'sistema.no_sistema', 'tipo_aviso_sistema.no_tipo_aviso_sistema')
                ->where('sistema.no_sistema', $sistema)
                ->where('aviso_sistema.sn_destaque', true)
                ->count();
	}

        public function geraAvisoSistemaGeral()
        {
                return $this->model->query() 
                ->join('spoa_portal.tipo_aviso_sistema', 'aviso_sistema.id_tipo_aviso_sistema', '=', 'tipo_aviso_sistema.id_tipo_aviso_sistema')
                ->select('aviso_sistema.*', 'tipo_aviso_sistema.no_tipo_aviso_sistema')
                ->whereNull('aviso_sistema.id_sistema')
                ->orderBy('nr_ordem', 'asc')
                ->get();
        }

	public function geraAvisoSistemaDestaqueGeral()
	{
		return $this->model->query() 
                ->join('spoa_portal.tipo_aviso_sistema', 'aviso_sistema.id_tipo_aviso_sistema', '=', 'tipo_aviso_sistema.id_tipo_aviso_sistema')
                ->select('aviso_sistema.*', 'tipo_aviso_sistema.no_tipo_aviso_sistema')
                ->where('aviso_sistema.sn_destaque', true)
                ->whereNull('aviso_sistema.id_sistema')
                ->orderBy('nr_ordem', 'asc')
                ->get();
	}

	public function qtdAvisoSistemaDestaqueGeral()
	{
		return $this->model->query()
                ->join('spoa_portal.tipo_aviso_sistema', 'aviso_sistema.id_tipo_aviso_sistema', '=', 'tipo_aviso_sistema.id_tipo_aviso_sistema')
                ->select('aviso_sistema.*', 'tipo_aviso_sistema.no_tipo_aviso_sistema')
                ->where('aviso_sistema.sn_destaque', true)
                ->whereNull('aviso_sistema.id_sistema')
                ->count();
	}

}