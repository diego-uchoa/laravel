<?php

namespace App\Modules\Sismed\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Sismed\Http\Requests\ServidorRequest;

use App\Modules\Sisadm\Repositories\SiapeCargoRepository;
use App\Modules\Sismed\Repositories\AtestadoRepository;
use App\Modules\Sismed\Repositories\ServidorRepository;
use App\Modules\Sismed\Repositories\ControleProntuarioRepository;
use App\Modules\Sismed\Repositories\ControleCicloRepository;
use App\Modules\Sismed\Enum\Situacao;
use App\Modules\Sismed\Enum\SituacaoServidor;
use App\Modules\Sismed\Enum\AreaAtendimento;
use App\Modules\Sismed\Enum\TipoAfastamento;
use App\Modules\Sismed\Enum\TipoPericia;
use App\Modules\Sismed\Enum\RegimeJuridico;

use Carbon\Carbon;
use Storage;
use Response;
use Yajra\Datatables\Datatables;

use App\Modules\Sisadm\Services\SiapeWsService;
use App\Modules\Sismed\Services\AtestadoService;
use App\Modules\Sismed\Services\CicloService;


class ServidorController extends Controller
{
    protected $siapeWsService;
    protected $repository;
    protected $atestadoRepository;
    protected $controleProntuarioRepository;
    protected $siapeCargoRepository;
    protected $controleCicloRepository;
    protected $atestadoService;
    protected $cicloService;

    public function __construct(ServidorRepository $repository, 
        AtestadoRepository $atestadoRepository,
        ControleProntuarioRepository $controleProntuarioRepository,
        SiapeWsService $SiapeWsService,
        SiapeCargoRepository $siapeCargoRepository,
        ControleCicloRepository $controleCicloRepository,
        AtestadoService $atestadoService,
        CicloService $cicloService)
    {
        $this->siapeWsService = $SiapeWsService;
        $this->repository = $repository;
        $this->atestadoRepository = $atestadoRepository;
        $this->controleProntuarioRepository = $controleProntuarioRepository;
        $this->siapeCargoRepository = $siapeCargoRepository;
        $this->controleCicloRepository = $controleCicloRepository;
        $this->atestadoService = $atestadoService;
        $this->cicloService = $cicloService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('sismed::servidor.index');
    }

    public function consulta(Request $request)
    {
        $servidores = $this->repository->select($request->all());

        return Datatables::of($servidores)
                ->addColumn('action', function ($servidor) {
                    return "<a href=".url('sismed/servidor/'.$servidor->id_servidor.'/atestados')." class='btn btn-xs btn-info'>
                                   <i class='ace-icon fa fa-folder-open-o'></i>
                               </a>";
                            })
                ->make(true);
    }

    public function consultaws(Request $request)
    {

        $servidor = Array();

        $wsDadosPessoais = $this->siapeWsService->findDadosPessoaisByCPF($request['nr_cpf']);

        if($wsDadosPessoais){
            $servidor ['no_servidor'] = $wsDadosPessoais['no_pessoa'];
            $servidor ['in_sexo'] = $wsDadosPessoais['in_sexo'];
            $servidor ['nr_cpf'] = $wsDadosPessoais['nr_cpf'];

            $data = new Carbon($wsDadosPessoais['dt_nascimento']);
            $servidor ['dt_nascimento'] = $data->format('d/m/Y');
        }



        $wsDadosFuncionais = $this->siapeWsService->findDadosFuncionaisByCPF($request['nr_cpf']);

        if(!empty($wsDadosFuncionais)){
            foreach ($wsDadosFuncionais as $wsdf) {

                if($wsdf['ds_ocorrencia_exclusao'] == ''){
                    $servidor ['nr_siape'] = $wsdf['nr_siape'];
                    $servidor ['tx_orgao'] = $wsdf['co_uorg_exercicio'];

                    if ($wsdf['co_cargo']){
                        $cargo = $this->siapeCargoRepository->find($wsdf['co_cargo']);
                        $servidor ['no_cargo'] = $cargo->no_cargo;
                    }else{
                        $servidor ['no_cargo'] = "";    
                    }
                }
                
            }
        }


        if(!empty($servidor)){
            return response(['status' => 'success','servidor'=> compact('servidor'), 'msg' => 'Consulta Realizada']);
        }
                
        else
                return response(['status' => 'empty','servidor'=> compact('servidor'), 'msg' => 'Consulta sem resultado']);    
    }

    /**
     * Atestados do Servidor.
     *
     * @return \Illuminate\Http\Response
     */
    public function atestados($id)
    {    

        $mode = '';
        $servidor = $this->repository->find($id);

        $atestados = $this->atestadoRepository->filterByIdServidor($id);

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

        if(\Request::query()){
            foreach ($ciclos as $ciclo) {
                $ciclosAgrupados[] = ['ciclo' => $ciclo,
                'acumulado' => $this->cicloService->calculaAcumulado($ciclo),
                'dataInicioAcumulado' => Carbon::parse($ciclo->dt_inicio_ciclo)->format('d/m/Y'),
                'dataFimAcumulado' => Carbon::parse($ciclo->dt_fim_ciclo)->format('d/m/Y')];
            }
            
            return view('sismed::servidor.atestado.servidor-atestados', compact('servidor','atestados','regimeJuridico','areaAtendimento','areaAtendimentoSelect','tipoAfastamento','tipoPericia','situacao','situacaoServidor','acumulado','mode','dataInicioAcumulado','dataFimAcumulado','cancelados','ciclosAgrupados'));
        }
        else
        {
            return view('sismed::servidor.atestado.servidor-atestados', compact('servidor','atestados','regimeJuridico','areaAtendimento','areaAtendimentoSelect','tipoAfastamento','tipoPericia','situacao','situacaoServidor','acumulado','mode','dataInicioAcumulado','dataFimAcumulado','cancelados','ciclos'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regimeJuridico = RegimeJuridico::getConstants();
        $situacaoServidor  = SituacaoServidor::getConstants();     

        return view('sismed::servidor.create', compact('regimeJuridico','situacaoServidor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServidorRequest $request)
    {
        //Código Prontuário
        $letraNomeServidor = substr($request['no_servidor'],0,1); 
        $ultimoNumeroProntuario = $this->controleProntuarioRepository->findByLetraProntuario($letraNomeServidor);       
        $request['co_prontuario'] = $ultimoNumeroProntuario->nr_prontuario.$letraNomeServidor;
        
        //Inclui Servidor
        $servidor = $this->repository->create($request->all());

        //Atualiza Código Prontuário
        $ultimoNumeroProntuario->nr_prontuario = $ultimoNumeroProntuario->nr_prontuario +1;
        $ultimoNumeroProntuario->save();

        return redirect()->route('sismed::servidor.atestados',['id'=>$servidor->id_servidor])->with('message', 'Servidor criado com sucesso!');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try{

            $this->repository->find($id)->update($request->all());

            $servidor = $this->repository->find($id);

            if ( $request->ajax() ){
                 
                return response(['msg' => 'Alterado com sucesso!', 'status' => 'success', 'servidor' => $servidor->toJson()]);
            }
            else{

                return redirect()->route('sismed::servidor.atestados', ['id' => $servidor->id_servidor]);
            
            }

        }
        catch(Exception $e){
            return response(['msg' => 'Erro ao excluir o registro.', 'status' => 422]);
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
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
