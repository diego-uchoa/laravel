<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\Tramitacao;
use DB;

class TramitacaoRepository extends AbstractRepository {

	public function __construct(Tramitacao $model) {
		$this->model = $model;
	}

	public function findByProposicao($idProposicao) {
		$emendas = Tramitacao::where([['id_proposicao','=',$idProposicao]])->get();

		return $emendas;
	}

	public function getByDtTramitacao($dtInicio, $dtFim) {
		return Tramitacao::join('spoa_portal_parla.proposicao','proposicao.id_proposicao','tramitacao.id_proposicao')
		    ->where('dt_data_tramitacao','>=',$dtInicio)
		    ->where('dt_data_tramitacao','<=',$dtFim)
		    ->select('proposicao.*')
		    ->distinct()
		    ->get();
	}
}