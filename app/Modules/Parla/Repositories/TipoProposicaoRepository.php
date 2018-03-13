<?php

namespace App\Modules\Parla\Repositories;

use App\Modules\Parla\Models\TipoProposicao;
use App\Repositories\AbstractRepository;

class TipoProposicaoRepository extends AbstractRepository
{
	public function __construct(TipoProposicao $model)
	{
		$this->model = $model;
	}

	public function preparaListaTiposProposicao() {
		$listaTiposCD  = array();
		$listaTiposSF  = array();

		$tiposCD = $this->filterByAttribute('sg_casa_origem', 'CD');
		$tiposSF = $this->filterByAttribute('sg_casa_origem', 'SF');

		$listaTiposProposicao[null] = 'Selecione ...';

		foreach ($tiposCD as $tipo) {
			$listaTiposCD[$tipo->sg_casa_origem.$tipo->sg_tipo_proposicao] = $tipo->sg_tipo_proposicao." - ".$tipo->tx_tipo_proposicao;
		}

		foreach ($tiposSF as $tipo) {
			$listaTiposSF[$tipo->sg_casa_origem.$tipo->sg_tipo_proposicao] = $tipo->sg_tipo_proposicao." - ".$tipo->tx_tipo_proposicao;
		}

		$listaTiposProposicao += array('Câmara dos Deputados' => $listaTiposCD, 'Senado Federal' => $listaTiposSF);

		return $listaTiposProposicao;        
	}
}