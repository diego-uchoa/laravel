<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gescon\Repositories\ContratoRepository;
use Carbon\Carbon;
use URL;

class GesconController extends Controller
{
	protected $contratoRepository;

	public function __construct(ContratoRepository $contratoRepository)
	{
		$this->middleware('auth');
		$this->contratoRepository = $contratoRepository;
	}

	public function index()
	{
		$calendario = $this->calendario();

		$dataInicio = Carbon::now();
		$dataFim = $dataInicio->copy()->addDays(180);
		$contratos = $this->contratoRepository->filterPeriodoDtCessacao($dataInicio,$dataFim);
		
		return view('gescon::index',['calendario' => $calendario, 'contratos' => $contratos]);
	}


	public function calendario() {

	    $contratos = $this->contratoRepository->findAllOrderByDataVencimento();
	    $eventosContratos0 = [];
	    $eventosContratos30 = [];
	    $eventosContratos120 = [];
	    $eventosContratos180 = [];
	    if (count($contratos) > 0) {
	        foreach ($contratos as $contrato) {
	            $data_vencimento = explode('/', $contrato->dt_cessacao);
				
				$data_hoje_Carbon = Carbon::now();	            
	            $dt_vencimento_Carbon = Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]);
	            $prazoVencimento = $data_hoje_Carbon->copy()->diffInDays($dt_vencimento_Carbon, false);
	            
	            if ($prazoVencimento < 0){
    	            $eventosContratos0[] = \Calendar::event(
    												$contrato->nr_contrato,
    												true,
    												Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]),
    												Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]),
    												$contrato->id_contrato
    				);	
	            }elseif($prazoVencimento >= 0 && $prazoVencimento <= 30){
    	            $eventosContratos30[] = \Calendar::event(
    												$contrato->nr_contrato,
    												true,
    												Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]),
    												Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]),
    												$contrato->id_contrato
    				);	
	            }elseif($prazoVencimento > 30 && $prazoVencimento <= 120){
    	            $eventosContratos120[] = \Calendar::event(
    												$contrato->nr_contrato,
    												true,
    												Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]),
    												Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]),
    												$contrato->id_contrato
    				);	
	            }elseif($prazoVencimento > 120 && $prazoVencimento <= 180){
    	            $eventosContratos180[] = \Calendar::event(
    												$contrato->nr_contrato,
    												true,
    												Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]),
    												Carbon::createFromDate($data_vencimento[2], $data_vencimento[1], $data_vencimento[0]),
    												$contrato->id_contrato
    				);	
	            }

	        }
	    }

	    $calendario = \Calendar::addEvents($eventosContratos0, [
	                'color' => '#ABBAC3',   //cinza
	                'route' => URL::route('gescon::contratos.calendario'),
	            ])
	        ->addEvents($eventosContratos30, [
	                'color' => '#D15B47',   //vermelho
	                'route' => URL::route('gescon::contratos.calendario'),
	            ])
	        ->addEvents($eventosContratos120, [
	                'color' => '#F89406', //amarelo
	                'route' => URL::route('gescon::contratos.calendario'),
	            ])
	        ->addEvents($eventosContratos180, [
	                'color' => '#82AF6F', //green
	                'route' => URL::route('gescon::contratos.calendario'),
	            ])
	        ->setOptions([
	                'locale' => 'pt-br',
	                'header' => [
	                    'left' => 'prev,next today novoButton',
	                    'center' => 'title',
	                    'right' => ''
	                ], 
	                'navLinks' => 'true'
	            ])
	        ->setCallbacks([
	                'eventClick' => 'function(event){
	                    $.fn.carregarDadosCalendario(event);
	                }'
	            ]); 

	    return $calendario;
	}

}