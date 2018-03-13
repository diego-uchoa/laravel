<?php

namespace App\Modules\Parla\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Parla\Services\ParlamentarService;
use App\Modules\Parla\Services\ComissaoService;
use App\Modules\Parla\Repositories\TramitacaoRepository;
use App\Modules\Parla\Repositories\ConsultaMfRepository;
use App\Modules\Parla\Repositories\RespostaMfRepository;
use App\Modules\Parla\Repositories\ProposicaoRepository;
use App\Modules\Parla\Repositories\ParlamentarRepository;
use App\Modules\Parla\Repositories\ComissaoRepository;
use GuzzleHttp\Client;
use Exception;
use Carbon\Carbon;
use Charts;

class ParlaController extends Controller
{
	protected $parlamentarCamaraWsService; 
	protected $comissaoService;
	protected $tramitacaoRepository;
	protected $consultaRepository;
	protected $proposicaoRepository;
	protected $parlamentarRepository;
	protected $respostaRepository;
	protected $comissaoRepository;

	public function __construct(ParlamentarService $parlamentarService, ComissaoService $comissaoService, TramitacaoRepository $tramitacaoRepository, ConsultaMfRepository $consultaRepository, ProposicaoRepository $proposicaoRepository, ParlamentarRepository $parlamentarRepository, RespostaMfRepository $respostaRepository, ComissaoRepository $comissaoRepository)
	{
		$this->parlamentarService = $parlamentarService;
		$this->comissaoService = $comissaoService;
		$this->tramitacaoRepository = $tramitacaoRepository;
		$this->consultaRepository = $consultaRepository;
		$this->proposicaoRepository = $proposicaoRepository;
		$this->parlamentarRepository = $parlamentarRepository;
		$this->respostaRepository = $respostaRepository;
		$this->comissaoRepository = $comissaoRepository;
       	$this->middleware('auth');
	}

	public function index() {

		$proposicoesCount = $this->proposicaoRepository->all()->count();
		$parlamentaresCount = $this->parlamentarRepository->all()->count();
		$consultasMfCount = $this->consultaRepository->all()->count();
		$respostasMfCount = $this->respostaRepository->all()->count();
		$comissoesCount = $this->comissaoRepository->all()->count();

		$dtInicio = date('Y-m-d', strtotime('last monday', strtotime('tomorrow')));
		$dtFim = date('Y-m-d', strtotime('+6 days', strtotime('last monday', strtotime('tomorrow'))));

		$proposicoes = $this->tramitacaoRepository->getByDtTramitacao($dtInicio,$dtFim);

		$proposicoesSemConsultas = $this->proposicaoRepository->getSemConsultas();

		$consultasPendentes = $this->consultaRepository->all()->where('status','P')->unique('id_proposicao');
		$consultasAtrasadas = $this->consultaRepository->all()->where('status','A')->unique('id_proposicao');

		$consultasGrafico = Charts::create('pie', 'highcharts')
		    ->colors(['#4CAF50','#03A9F4','#F44336'])
		    ->title("Consultas ao MF")
		    ->labels(['Concluídas', 'Pendentes','Atrasadas'])
		    ->values([$this->consultaRepository->all()->where('status','C')->count(),$this->consultaRepository->all()->where('status','P')->count(),$this->consultaRepository->all()->where('status','A')->count()]); 
		

		$dtInicio = Carbon::parse($dtInicio)->format('d/m/Y');
		$dtFim = Carbon::parse($dtFim)->format('d/m/Y');

		return view('parla::index', compact('proposicoesCount','parlamentaresCount','consultasMfCount','respostasMfCount','comissoesCount','proposicoes','proposicoesSemConsultas','dtInicio','dtFim','consultasPendentes','consultasAtrasadas','consultasGrafico'));
	}
}