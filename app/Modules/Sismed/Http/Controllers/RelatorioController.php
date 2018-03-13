<?php

namespace App\Modules\Sismed\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;

use App\Modules\Sismed\Repositories\AtestadoRepository;
use App\Modules\Sismed\Repositories\ServidorRepository;

class RelatorioController extends Controller
{
   	public function __construct(AtestadoRepository $atestadoRepository, 
   	    ServidorRepository $servidorRepository)
   	{
   	    $this->atestadoRepository = $atestadoRepository;
   	    $this->servidorRepository = $servidorRepository;
   	}

      public function index(){
         return view('sismed::relatorio.index');
      }


      public function atestados(Request $request)
      {
         $dataInicio = $request['dt_inicio_cadastro'];
         $dataFim = $request['dt_fim_cadastro'];

         $atestados = $this->atestadoRepository->filterAtestado($request->all())->count();

         $situacaoConcluido = $this->atestadoRepository->filterAtestado($request->all())->where('in_situacao', 'C')->count();

         $situacaoPendente = $this->atestadoRepository->filterAtestado($request->all())->where('in_situacao', 'P')->count();

         $situacaoApericiar = $this->atestadoRepository->filterAtestado($request->all())->where('in_situacao', 'A')->count();

         

         $areaMedica = $this->atestadoRepository->filterAtestado($request->all())->where('in_area_atendimento', 'M')->count();

         $areaOdontologica = $this->atestadoRepository->filterAtestado($request->all())->where('in_area_atendimento', 'O')->count();


         
         $afastamentoAcompanhamento = $this->atestadoRepository->filterAtestado($request->all())->where('in_tipo_afastamento', 'A')->count();
         
         $afastamentoProprio = $this->atestadoRepository->filterAtestado($request->all())->where('in_tipo_afastamento', 'P')->count();

         
         //return view('sismed::relatorio.atestados-pdf-novo', compact('atestados','situacaoConcluido','situacaoPendente','situacaoApericiar','areaOdontologica','areaMedica','afastamentoProprio','afastamentoAcompanhamento','dataInicio','dataFim'));

         $pdf = PDF::loadView('sismed::relatorio.atestados-pdf', compact('atestados','situacaoConcluido','situacaoPendente','situacaoApericiar','areaOdontologica','areaMedica','afastamentoProprio','afastamentoAcompanhamento','dataInicio','dataFim'));
          
         return $pdf->download('relatorio_atestados.pdf');
          
      }
}
