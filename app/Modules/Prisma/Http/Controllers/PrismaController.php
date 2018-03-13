<?php

namespace App\Modules\Prisma\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Prisma\Repositories\SolicitacaoCadastroRepository;

class PrismaController extends Controller
{
	protected $solicitacaoCadastroRepository;

	public function __construct(SolicitacaoCadastroRepository $solicitacaoCadastroRepository) {
       	$this->solicitacaoCadastroRepository = $solicitacaoCadastroRepository;
	}

	public function index() {
		$solicitacoes = $this->solicitacaoCadastroRepository->getPendentesEmAnalise();
		return view('prisma::index',compact('solicitacoes'));
	}
}