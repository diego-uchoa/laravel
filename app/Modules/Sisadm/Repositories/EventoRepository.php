<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\Evento;

use DateTime;

class EventoRepository extends AbstractRepository
{

	public function __construct(Evento $model)
	{
		$this->model = $model;
	}

	/**
	 * Recuperar todos os registros ativos dos eventos, ordenando-os pelo nome
	 * @return Array Evento
	 */
	public function findAllOrderByName()
	{
        $eventos = $this->findAll(['no_evento']);

        return $eventos;
	}   

	public function getListaEventosAno()
	{
		$dataInicio = (new DateTime('now'))->modify('-1 year');
		$dataFim =  (new DateTime('now'))->modify('+1 year');
		return $this->model->query()
			->where('dt_inicio', '>=', $dataInicio)
			->where('dt_inicio', '<=', $dataFim)
			->get();
	}

}