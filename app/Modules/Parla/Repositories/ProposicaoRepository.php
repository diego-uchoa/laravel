<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\Proposicao;
use DB;

class ProposicaoRepository extends AbstractRepository {

	public function __construct(Proposicao $model) {
		$this->model = $model;
	}

	public function findBySiglaNumeroAno($casa, $sigla, $numero, $ano) {

		$proposicao = Proposicao::withTrashed()->where([['sg_casa_origem','=',$casa],['sg_sigla_origem','=',strtoupper($sigla)],['nr_numero_origem','=',$numero],['an_ano_origem','=',$ano]])->orWhere([['sg_casa_revisora','=',$casa],['sg_sigla_revisora','=',$sigla],['nr_numero_revisora','=',$numero],['an_ano_revisora','=',$ano]])->get();

		return $proposicao;
	}

	public function preparaListaProposicoes() {
		$listaProposicoes  = array();

		$proposicoes = $this->all();

		$listaProposicoes[null] = 'Selecione ...';

		foreach ($proposicoes as $proposicao) {
			$listaProposicoes[$proposicao->id_proposicao] = $proposicao->origem;
			if($proposicao->sn_possui_revisora) {
				$listaProposicoes[$proposicao->id_proposicao] .= ' - '.$proposicao->revisora;
			}
		}

		return $listaProposicoes;        
	}

	public function getSemConsultas() {
		return Proposicao::doesnthave('consultas')->get();
	}
}