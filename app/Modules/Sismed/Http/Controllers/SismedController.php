<?php

namespace App\Modules\Sismed\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Charts;

use App\Modules\Sismed\Repositories\AtestadoRepository;
use App\Modules\Sismed\Repositories\ServidorRepository;
use App\Modules\Sismed\Repositories\PericiaRepository;

class SismedController extends Controller
{
	protected $servidorRepository;
	protected $atestadoRepository;
	protected $periciaRepository;

	public function __construct(AtestadoRepository $atestadoRepository,
		ServidorRepository $servidorRepository,
		PericiaRepository $periciaRepository)
	{
       	$this->middleware('auth');
       	$this->atestadoRepository = $atestadoRepository;
       	$this->servidorRepository = $servidorRepository;
       	$this->periciaRepository = $periciaRepository;
	}

	public function index(Request $request)
	{
		if($request->has('ano')){
			$ano = $request->get('ano');
		}else{
			$ano = date("Y");
		}

		$servidores = $this->servidorRepository->all();
		$atestados = $this->atestadoRepository->all();
		$pericias = $this->periciaRepository->all();

		$labels = [
			'Janeiro, '.$ano,
			'Fevereiro, '.$ano,
			'Março, '.$ano,
			'Abril, '.$ano,
			'Maio, '.$ano,
			'Junho, '.$ano,
			'Julho, '.$ano,
			'Agosto, '.$ano,
			'Setembro, '.$ano,
			'Outubro, '.$ano,
			'Novembro, '.$ano,
			'Dezembro, '.$ano,
		];

		$atestadosAno = $this->atestadoRepository->filterByAno($ano);

		
		$graficoAtestado = Charts::database($atestadosAno, 'bar', 'highcharts')
		->title("Atestados/mês - ".$ano)
	    ->elementLabel("Total")
	    ->dimensions(500, 400)
	    ->responsive(true)
	    ->groupByMonth($ano, true)
	    ->labels($labels);

	    $graficoAtestadoPie = Charts::database($atestadosAno, 'pie', 'highcharts')
	            ->title('Atestados/situação -'.$ano)
	            ->dimensions(500, 400)
	            ->responsive(true)
	            ->groupBy('in_situacao', null, ['A' => 'A periciar', 'C' => 'Concluído', 'X' => 'Cancelado']);

	    

		return view('sismed::index', ['graficoAtestado' => $graficoAtestado, 'graficoLaudo' => $graficoAtestadoPie, 
				'servidores' =>$servidores->count(),
				'pericias' => $pericias->count(),
				'apericiar' => $pericias->where('in_situacao','A')->count(),
				'concluidas' => $pericias->where('in_situacao','C')->count(),
				'atestados' => $atestados->count(),
				'ano' => $ano]);
	}

}