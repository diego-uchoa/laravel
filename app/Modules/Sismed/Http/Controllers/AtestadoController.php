<?php

namespace App\Modules\Sismed\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Sismed\Http\Requests\AtestadoRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\UtilHelper;

use App\Modules\Sismed\Repositories\AtestadoRepository;
use App\Modules\Sismed\Repositories\ServidorRepository;
use App\Modules\Sismed\Repositories\PericiaRepository;
use App\Modules\Sismed\Repositories\ControleCicloRepository;
use App\Modules\Sismed\Enum\Situacao;
use App\Modules\Sismed\Enum\SituacaoServidor;
use App\Modules\Sismed\Enum\AreaAtendimento;
use App\Modules\Sismed\Enum\TipoAfastamento;
use App\Modules\Sismed\Enum\TipoPericia;
use App\Modules\Sismed\Enum\RegimeJuridico;

use App\Modules\Sismed\Services\AtestadoService;
use App\Modules\Sismed\Services\CicloService;

use Storage;
use Carbon\Carbon;
use Mail;
use Session;
use Log;
use App\Http\Upload;
use PDF;
use Yajra\Datatables\Datatables;

class AtestadoController extends Controller
{
    protected $repository;
    protected $servidorRepository;
    protected $controleCicloRepository;
    protected $atestadoService;
    protected $cicloService;

    public function __construct(
        AtestadoService $atestadoService,
        AtestadoRepository $repository, 
        ServidorRepository $servidorRepository,
        PericiaRepository $periciaRepository,
        ControleCicloRepository $controleCicloRepository,
        CicloService $cicloService)
    {
        $this->repository = $repository;
        $this->atestadoService = $atestadoService;
        $this->servidorRepository = $servidorRepository;
        $this->periciaRepository = $periciaRepository;
        $this->controleCicloRepository = $controleCicloRepository;
        $this->cicloService = $cicloService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areaAtendimento = AreaAtendimento::lists();
        $tipoAfastamento = TipoAfastamento::lists();
        $tipoPericia = TipoPericia::lists();
        $situacao = Situacao::lists();   
        return view('sismed::servidor.atestado.index',compact('areaAtendimento','tipoAfastamento','tipoPericia','situacao'));

    }

    public function consulta(Request $request)
    {
        $atestados = $this->repository->select($request->all());

        return Datatables::of($atestados)
                ->addColumn('in_area_atendimento', function ($atestado) {
                                return $atestado->areaAtendimento();
                            })
                ->addColumn('in_tipo_afastamento', function ($atestado) {
                                return $atestado->tipoAfastamento();
                            })
                ->addColumn('in_tipo_pericia', function ($atestado) {
                                return $this->atestadoService->recuperaTipoPericia($atestado);
                            })
                ->addColumn('in_situacao', function ($atestado) {
                                return $atestado->situacao();
                            })
                ->addColumn('action', function ($atestado) {
                    return "<a href=".url('sismed/servidor/'.$atestado->id_servidor.'/atestados')." class='btn btn-xs btn-info'>
                                   <i class='ace-icon fa fa-folder-open-o'></i>
                               </a>";
                            })

                ->addColumn('observacao', function ($atestado) {

                        if(!empty($atestado->tx_observacao)){
                            return "<a href=".url('sismed/servidor/'.$atestado->id_servidor.'/atestados')." class='btn btn-xs btn-warning' data-rel='tooltip'>
                                <i class='ace-icon fa fa-exclamation-circle'></i></a>";
    
                        }else{
                            return "";
                        }
                    
                    })
                ->filterColumn('dt_inicio_afastamento', function ($query, $keyword) {
                                $keyword = Carbon::createFromFormat('d/m/Y', $keyword)->toDateString();
                                $query->where('dt_inicio_afastamento','=',["%$keyword%"]);
                })
                ->filterColumn('dt_fim_afastamento', function ($query, $keyword) {
                                $keyword = Carbon::createFromFormat('d/m/Y', $keyword)->toDateString();
                                $query->where('dt_fim_afastamento','=',["%$keyword%"]);
                })
                ->filter(function ($query) use ($request) {
                    if ($request->filled('inicio_dt_registro')) {
                        $parametro = Carbon::createFromFormat('d/m/Y', $request->get('inicio_dt_registro'))->toDateString();
                        $query->where('atestado.created_at','>=',$parametro);
                    }

                    if ($request->filled('fim_dt_registro')) {
                        $parametro = Carbon::createFromFormat('d/m/Y', $request->get('fim_dt_registro'))->toDateString();
                        $query->where('atestado.created_at','<=',$parametro);
                    }

                    if ($request->filled('inicio_dt_inicio')) {
                        $parametro = Carbon::createFromFormat('d/m/Y', $request->get('inicio_dt_inicio'))->toDateString();
                        $query->where('dt_inicio_afastamento','>=',$parametro);
                    }

                    if ($request->filled('inicio_dt_fim')) {
                        $parametro = Carbon::createFromFormat('d/m/Y', $request->get('inicio_dt_fim'))->toDateString();
                        $query->where('dt_inicio_afastamento','<=',$parametro);
                    }

                    if ($request->filled('fim_dt_inicio')) {
                        $parametro = Carbon::createFromFormat('d/m/Y', $request->get('fim_dt_inicio'))->toDateString();
                        $query->where('dt_fim_afastamento','>=',$parametro);
                    }

                    if ($request->filled('fim_dt_fim')) {
                        $parametro = Carbon::createFromFormat('d/m/Y', $request->get('fim_dt_fim'))->toDateString();
                        $query->where('dt_fim_afastamento','<=',$parametro);
                    }

                    if ($request->filled('area_atendimento')) {                       
                        $parametro = $request->get('area_atendimento');
                        $query->where('in_area_atendimento','=',$parametro);
                    }

                    if ($request->filled('tipo_afastamento')) {                       
                        $parametro = $request->get('tipo_afastamento');
                        $query->where('in_tipo_afastamento','=',$parametro);
                    }

                    if ($request->filled('tipo_pericia')) {
                       
                        $parametro = $request->get('tipo_pericia');
                        $query->whereHas('pericias', function($q) use($parametro) {
                                    $q->where('in_tipo_pericia', $parametro);
                                });

                    }
                    if ($request->filled('situacao')) {                       
                        $parametro = $request->get('situacao');
                        $query->where('in_situacao','=',$parametro);
                    }

                    if ($request->filled('prazo')) {                       
                        $parametro = $request->get('prazo');
                        $query->where('te_prazo','=',$parametro);
                    }

                    if ($request->filled('observacao')) {                       
                        $parametro = $request->get('observacao');
                        $query->where('tx_observacao','like',$parametro);
                    }
                })
                
                ->rawColumns(['observacao', 'action'])
                ->make(true);
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $servidor = $this->servidorRepository->find($id);

        $mode = "create";

        $areaAtendimento = AreaAtendimento::getConstants();
        $tipoAfastamento = TipoAfastamento::getConstants();
        $tipoPericia = TipoPericia::getConstants();
        $situacao = Situacao::lists();

        $html = view('sismed::servidor.atestado._modal', compact('mode','servidor','areaAtendimento','tipoAfastamento','tipoPericia','situacao'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);


        //return view('sismed::servidor.atestado.create', compact('servidor','mode','areaAtendimento','tipoAfastamento','tipoPericia','situacao'));
  
    }

    
            

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtestadoRequest $request)
    {
        
        $mode = '';

        try{

            $atestado = $this->atestadoService->store($request);
             
            if ( $request->ajax() ){

                $atestados = $this->repository->filterByIdServidor($request['id_servidor']);
                
                $pericias = $this->periciaRepository->filterByIdAtestado($atestado->id_atestado);

                $html = view('sismed::servidor.atestado._tabela', compact('atestados','servidor'))->render();
                $htmlPericia = view('sismed::servidor.atestado.pericia._tabela', compact('pericias'))->render();  
                return response(['msg' => 'Incluído com sucesso!', 'status' => 'success', 'html'=> $html,'html_pericia'=> $htmlPericia, 'mode'=> $mode]);

            }
            else{

                $servidor = $this->servidorRepository->find($request['id_servidor']);
                $pericias = $this->periciaRepository->filterByIdAtestado($atestado->id_atestado);
                $areaAtendimento = AreaAtendimento::getConstants();
                $tipoAfastamento = TipoAfastamento::getConstants();
                $tipoPericia = TipoPericia::getConstants();
                $situacao = Situacao::lists();
                $mode = 'update';
                
                return redirect()->route('sismed::atestado.edit',['id'=>$atestado->id_atestado])->with('message', 'Atestado registrado com sucesso!');
            
            }

        }
        catch(Exception $e){
            return response(['msg' => 'Erro ao salvar o registro.', 'status' => 422]);
        }
        
        
    }


    public function show()
    {
        $cpf = array(
            "nr_cpf" => UtilHelper::getUsername(),
        ); 

        $servidor = $this->servidorRepository->filterServidor($cpf)->first();
        $ciclos = $this->controleCicloRepository->filterByIdServidor($servidor->id_servidor);
        $cancelados = $this->controleCicloRepository->filterCanceladosByIdServidor($servidor->id_servidor);

        if($servidor)
        {
            $atestados = $this->repository->filterByIdServidor($servidor->id_servidor);
            return view('sismed::servidor.atestado.show', compact('servidor','atestados','ciclos','cancelados'));    
        }
        else
        {   
            Session::flash('warning', 'Usuário não possui prontuário cadastrado no SISMED.');
            return view('sismed::servidor.atestado.show');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $atestado = $this->repository->find($id);

        $mode = "update";

        $dataInicioAfastamento = $atestado->dt_inicio_afastamento;
        $dataFimAfastamento = $atestado->dt_fim_afastamento;
        
        $areaAtendimento = AreaAtendimento::getConstants();
        $tipoAfastamento = TipoAfastamento::getConstants();
        $tipoPericia = TipoPericia::getConstants();
        $situacao = Situacao::lists();

        $servidor = $this->servidorRepository->find($atestado->id_servidor);

        $pericias = $this->periciaRepository->filterByIdAtestado($atestado->id_atestado);

        return view('sismed::servidor.atestado.edit', compact('atestado', 'mode','areaAtendimento','tipoAfastamento','tipoPericia','situacao','servidor', 'dataInicioAfastamento', 'dataFimAfastamento','pericias'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AtestadoRequest $request, $id)
    {
        
        try{
            
           
            $atestado = $this->atestadoService->update($request,$id);
            
            $mode = "";  

            if ( $request->ajax() ){
                $atestados = $this->repository->filterByIdServidor($request['id_servidor']);
                $html = view('sismed::servidor.atestado._tabela', compact('atestados','servidor'))->render(); 
                return response(['msg' => 'Alterado com sucesso!', 'status' => 'success', 'html'=> $html, 'mode'=> $mode]);
            }
            else{

                $mode = '';
                $servidor = $this->servidorRepository->find($request['id_servidor']);
                $atestados = $this->repository->filterByIdServidor($request['id_servidor']);


                $dataAtual = Carbon::now()->toDateString();

                $controleCiclo = $this->controleCicloRepository->filterByIdServidorData($servidor->id_servidor,$dataAtual)->first();
                
                if($controleCiclo){
                    $acumulado = $this->cicloService->calculaAcumulado($controleCiclo);
                    $dataInicioAcumulado = Carbon::parse($controleCiclo->dt_inicio_ciclo)->format('d/m/Y');
                    $dataFimAcumulado = Carbon::parse($controleCiclo->dt_fim_ciclo)->format('d/m/Y');
                }else{
                    $acumulado = '0';
                    $dataInicioAcumulado = '';
                    $dataFimAcumulado = '';
                }

                $ciclos = $this->controleCicloRepository->filterByIdServidor($servidor->id_servidor);
                $cancelados = $this->controleCicloRepository->filterCanceladosByIdServidor($servidor->id_servidor);

                $areaAtendimento = AreaAtendimento::getConstants();
                $areaAtendimentoSelect = '';
                
                $tipoAfastamento = TipoAfastamento::getConstants();

                $tipoPericia = TipoPericia::getConstants();

                $situacao = Situacao::lists();
                $regimeJuridico = RegimeJuridico::getConstants();
                $situacaoServidor = SituacaoServidor::getConstants(); 

                return view('sismed::servidor.atestado.servidor-atestados', compact('servidor','atestados','regimeJuridico','areaAtendimento','areaAtendimentoSelect','tipoAfastamento','tipoPericia','situacao','situacaoServidor','acumulado','mode','dataInicioAcumulado','dataFimAcumulado','ciclos','cancelados'))->with('message', 'Atestado atualizado com sucesso!');;

            
            }

        }
        catch(Exception $e){
            return response(['msg' => 'Erro ao atualizar o registro.', 'status' => 422]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtestadoRequest $request)
    {
        
        try{

            $atestado = $this->repository->find($request['id_atestado']);
            $idServidor = $atestado->id_servidor;
            $justificativa = $request['tx_justificativa_exclusao'];

            $this->atestadoService->destroy($atestado,$justificativa);

            $mode = "";
            $atestados = $this->repository->filterByIdServidor($idServidor);
            $servidor = $this->servidorRepository->find($idServidor);
            $ciclos = $this->controleCicloRepository->filterByIdServidor($idServidor);

            $html = view('sismed::servidor.atestado._tabela', compact('atestados','servidor','ciclos'))->render(); 
            return response(['msg' => 'Registro excluído com sucesso.', 'status' => 'success', 'html'=> $html, 'mode'=> $mode]);

        }
        catch(Exception $e){
            return response(['msg' => 'Erro ao excluir o registro.', 'status' => 422]);
        }
                
    }


    public function emitirRecibo($id)
    {
        
        $atestado = $this->repository->find($id);
        $servidor = $this->servidorRepository->find($atestado->id_servidor);

        $path = public_path();

        $combinacao = $atestado->in_area_atendimento.$atestado->in_tipo_afastamento.$atestado->in_tipo_pericia;

        $arrayTextoPericia = [
        'MPS' => 'médica singular própria.',
        'MPJ' => 'médica própria por Junta.',
        'MAS' => 'médica singular de acompanhamento.',
        'MAJ' => 'médica de acompanhamento por Junta.',
        'OPS' => 'odontológica singular própria.',
        'OPJ' => 'odontológica própria por Junta.',
        'OAS' => 'odontológica singular de acompanhamento.',
        'OAJ' => 'odontológica de acompanhamento por Junta.',
        'GPS' => 'gestante singular própria.',
        'GPJ' => 'gestante própria por Junta.',
        'GAS' => 'gestante singular de acompanhamento.',
        'GAJ' => 'gestante de acompanhamento por Junta.'
        ];

        if(isset($arrayTextoPericia[$combinacao])){
            $textoPericia = $arrayTextoPericia[$combinacao];
        }else{
            $textoPericia = '.';
        }

        



        //return view('sismed::relatorio.recibo-atestado-pdf', compact('servidor','atestado','path','textoPericia'));

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('sismed::relatorio.recibo-atestado-pdf', compact('servidor','atestado','path','textoPericia'));
        
        return $pdf->download('recibo_entrega_atestado.pdf');
        
    }


    public function cancelarAlertar($id){

        $atestado = $this->repository->find($id);
        $atestados = $this->atestadoService->buscaAtestadosSubsequentes($atestado);
        $servidor = $this->servidorRepository->find($atestado->id_servidor); 

        return view('sismed::servidor.atestado.cancelar', compact('atestado','atestados','servidor'));    

    }

    public function cancelar($id){
        $atestado = $this->repository->find($id);
        $servidor = $this->servidorRepository->find($atestado->id_servidor);

        
        $this->atestadoService->cancelar($atestado);

        return redirect()->route('sismed::servidor.atestados',['id'=>$servidor->id_servidor])->with('message', 'Atestado Cancelado!');    

    }    


}