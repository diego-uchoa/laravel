<?php

namespace App\Modules\Sishelp\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Sishelp\Repositories\AjudaArquivoRepository;
use App\Modules\Sishelp\Repositories\AjudaFaqRepository;
use App\Modules\Sishelp\Repositories\AjudaGeralRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;


class AjudaSistemaController extends Controller
{

	protected $ajudaArquivoRepository;
	protected $ajudaFaqRepository;
	protected $ajudaGeralRepository;
	protected $sistemaRepository;


	public function __construct(AjudaArquivoRepository $ajudaArquivoRepository, AjudaFaqRepository $ajudaFaqRepository, AjudaGeralRepository $ajudaGeralRepository, SistemaRepository $sistemaRepository)
	{
       	$this->ajudaArquivoRepository = $ajudaArquivoRepository;
       	$this->ajudaFaqRepository = $ajudaFaqRepository;
       	$this->ajudaGeralRepository = $ajudaGeralRepository;
       	$this->sistemaRepository = $sistemaRepository;
	}

	public function index($nomeSistema)
	{
        
        $sistema = $this->sistemaRepository->findByNome($nomeSistema);
        $manuais = $this->ajudaArquivoRepository->filterBySistema($sistema);
        $faqs = $this->ajudaFaqRepository->filterBySistema($sistema);
        $geral = $this->ajudaGeralRepository->findBySistema($sistema);

        return view('sishelp::ajuda_sistema.index', compact('manuais','faqs', 'geral'));
	}

}