<?php
namespace App\Modules\Prisma\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Prisma\Models\SolicitacaoCadastroEditor;

class SolicitacaoCadastroEditorRepository extends AbstractRepository
{

	public function __construct(SolicitacaoCadastroEditor $model)
	{
		$this->model = $model;
	}

}