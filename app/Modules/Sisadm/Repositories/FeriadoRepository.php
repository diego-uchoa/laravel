<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\Feriado;

use DateTime;

class FeriadoRepository extends AbstractRepository
{

	public function __construct(Feriado $model)
	{
		$this->model = $model;
	}

	/**
	 * Recuperar todos os registros ativos dos feriados, ordenando-os pelo nome
	 * @return Array Feriado
	 */
	public function findAllOrderByName()
	{
        $feriados = $this->findAll(['no_feriado']);

        return $feriados;
	}   

	public function getListaFeriadosAno()
	{
		$dataInicio = new DateTime('now');
		$dataFim =  (new DateTime('now'))->modify('+1 year');
		return $this->model->query()
			->where('dt_feriado', '>=', $dataInicio)
			->where('dt_feriado', '<=', $dataFim)
			->get();
	}

}