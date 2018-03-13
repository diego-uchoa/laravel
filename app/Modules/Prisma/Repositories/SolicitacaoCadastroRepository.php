<?php
namespace App\Modules\Prisma\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Prisma\Models\SolicitacaoCadastro;

class SolicitacaoCadastroRepository extends AbstractRepository
{

	public function __construct(SolicitacaoCadastro $model)
	{
		$this->model = $model;
	}

	public function getPendentesEmAnalise() {
		return SolicitacaoCadastro::where('in_situacao_solicitacao','E')->orWhere('in_situacao_solicitacao','P')->get();
	}

}