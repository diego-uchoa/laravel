<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Repositories\ContratoRepository;
use App\Modules\Gescon\Services\ContratoSiasgWsService;
use App\Modules\Gescon\Services\ContratoService;
use App\Modules\Gescon\Repositories\ModalidadeRepository;
use App\Modules\Gescon\Repositories\IndiceVariacaoRepository;
use App\Modules\Gescon\Repositories\ContratanteRepository;
use App\Modules\Gescon\Repositories\ContratanteUsuarioRepository;
use App\Modules\Gescon\Repositories\ContratanteAssinanteRepository;
use App\Repositories\UfRepository;
use App\Modules\Gescon\Http\Requests\ContratoEncerramentoRequest;
use App\Modules\Gescon\Enum\TipoContratada;
use App\Modules\Gescon\Enum\TipoContrato;
use App\Modules\Gescon\Enum\TipoEmpenho;
use App\Modules\Gescon\Enum\TipoFiscal;
use App\Modules\Gescon\Enum\TipoVariacao;
use App\Modules\Gescon\Enum\ModalidadeGarantia;
use App\Modules\Gescon\Enum\ObjetoContrato;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Helpers\UtilHelper;
use App\Http\Upload;
use Auth;

class ContratoController extends Controller
{
    protected $contratoRepository;
    protected $contratoServiceWsService;
    protected $contratoService;
    protected $modalidadeRepository;
    protected $indiceVariacaoRepository;
    protected $ufRepository;
    protected $municipioRepository;
    protected $contratanteUsuarioRepository, $contratanteAssinanteRepository;
    protected $contrato, $in_objeto, $listaUasg, $listaTipoContrato, $listaTipoVariacao;
    protected $ds_objeto, $listaModalidadeGarantia, $listaTipoFiscal;
    protected $listaModalidade, $listaIndiceVariacao, $listaUF, $listaMunicipio, $listaTipoEmpenho, $listaTipoContratada;

    public function __construct()
    {
        $this->contratoRepository = \App::make('App\Modules\Gescon\Repositories\ContratoRepository');
        $this->contratoService = \App::make('App\Modules\Gescon\Services\ContratoService');
        $this->contratoServiceWsService = \App::make('App\Modules\Gescon\Services\ContratoSiasgWsService');
        $this->modalidadeRepository = \App::make('App\Modules\Gescon\Repositories\ModalidadeRepository');
        $this->indiceVariacaoRepository = \App::make('App\Modules\Gescon\Repositories\IndiceVariacaoRepository');
        $this->ufRepository = \App::make('App\Repositories\UfRepository');
        $this->municipioRepository = \App::make('App\Repositories\MunicipioRepository');
        $this->contratanteUsuarioRepository = \App::make('App\Modules\Gescon\Repositories\ContratanteUsuarioRepository');
        $this->contratanteAssinanteRepository = \App::make('App\Modules\Gescon\Repositories\ContratanteAssinanteRepository');
    }
    
    /**
     * Exibir uma listagem dos Contratos.
     *
     */
    public function index()
    {
        $mode = "";
        return view('gescon::contratos.index', compact('mode'));
    }

    /**
     * Recuperar os registros de Contratos cadastrados
     *
     */
    public function records(Request $request)
    {   
        $contratos = $this->contratoRepository->findAllOrderByDataVencimento();
        return Datatables::of($contratos)
                
                ->addColumn('nr_contrato', function ($contrato) {
                                return $contrato->nr_contrato;
                            })
                ->addColumn('in_tipo', function ($contrato) {
                                return $contrato->modalidade->no_modalidade;
                            })
                ->addColumn('ds_objeto', function ($contrato) {
                                return $contrato->ds_objeto;
                            })
                ->addColumn('dt_cessacao', function ($contrato) {
                                return $contrato->dt_cessacao;
                            })

                ->addColumn('operacoes', function ($contrato) {
                    return "<a href=". $contrato->rota_edicao_contrato ." class='btn btn-xs btn-info update' data-rel='tooltip' data-original-title='Editar Contrato'>
                                <i class='ace-icon fa fa-pencil'></i>
                            </a>
                            <a href='#' class='btn btn-xs btn-success modal_encerrar' data-url=".url('gescon/contratos/modal_encerramento/'.$contrato->id_contrato.'')." data-rel='tooltip' data-original-title='Encerrar Contrato'>
                                <i class='ace-icon fa fa-gavel'></i>
                            </a>
                            <a href='#' data-id='{{ $contrato->id_contrato }}' data-url=".url('gescon/contratos/destroy/'.$contrato->id_contrato.'')." class='btn btn-xs btn-danger delete' data-rel='tooltip' data-original-title='Excluir Contrato'>
                                <i class='ace-icon fa fa-trash-o'></i>
                            </a>   ";
                            })
                ->rawColumns(['operacoes'])
                ->make(true);
    }

    /**
     * Responsável por carregar os dados comuns do Contrato, para inclusão
     */
    public function create($inObjeto)
    {   
        $this->ds_objeto = ObjetoContrato::getValue($inObjeto);
        $this->listaUasg = $this->contratanteUsuarioRepository->listUasgByUsuario(Auth::user()->id_usuario);
        $this->listaAssinante = ['0' => 'Selecione...'];
        $this->listaTipoContrato = TipoContrato::getConstants();
        $this->listaTipoVariacao = TipoVariacao::getConstants();
        $this->listaTipoVariacao = array(""=>"Selecione...") + $this->listaTipoVariacao;
        $this->listaModalidadeGarantia = ModalidadeGarantia::getConstants();
        $this->listaTipoFiscal = TipoFiscal::getConstants();
        $this->listaTipoEmpenho = TipoEmpenho::getConstants();
        $this->listaTipoEmpenho = array(""=>"Selecione...") + $this->listaTipoEmpenho;
        $this->listaTipoContratada = TipoContratada::getConstants();
        $this->listaModalidade = $this->modalidadeRepository->lists('no_modalidade','id_modalidade');
        $this->listaIndiceVariacao = $this->indiceVariacaoRepository->listsOpcional('sg_indice_variacao','id_indice_variacao')->prepend('Selecione...','');
        $this->listaUF = $this->ufRepository->lists('sg_uf','id_uf');
        $this->listaMunicipio = ['0' => 'Selecione...'];
    }

    /**
    * Responsável por recuperar dados comuns do Contrato, para alteração
    * @param  Integer id
    */
    public function edit($id)
    {
        $this->contrato = $this->contratoRepository->findContratoUASGById($id);
    
        if (count($this->contrato) == 0){

            abort(403, 'Você não tem acesso para editar esse contrato.');

        }else{

            $this->in_objeto = $this->contrato->in_objeto;
            $this->ds_objeto = ObjetoContrato::getValue($this->in_objeto);
            $this->listaUasg = $this->contratanteUsuarioRepository->listUasgByUsuario(Auth::user()->id_usuario);
            $this->listaTipoContrato = TipoContrato::getConstants();
            $this->listaTipoVariacao = TipoVariacao::getConstants();
            $this->listaTipoVariacao = array(""=>"Selecione...") + $this->listaTipoVariacao;
            $this->listaModalidadeGarantia = ModalidadeGarantia::getConstants();
            $this->listaTipoFiscal = TipoFiscal::getConstants();
            $this->listaTipoEmpenho = TipoEmpenho::getConstants();
            $this->listaTipoEmpenho = array(""=>"Selecione...") + $this->listaTipoEmpenho;
            $this->listaTipoContratada = TipoContratada::getConstants();
            $this->listaModalidade = $this->modalidadeRepository->lists('no_modalidade','id_modalidade');
            $this->listaIndiceVariacao = $this->indiceVariacaoRepository->lists('sg_indice_variacao','id_indice_variacao')->prepend('Selecione...','');;
            $this->listaUF = $this->ufRepository->lists('sg_uf','id_uf');
            $this->listaMunicipio = $this->municipioRepository->listsByAttribute('no_municipio','id_municipio','id_uf', $this->contrato->contratada->municipio->uf->id_uf);

        }

    }


    /**
     * Remove um Contrato específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{
            
            $this->contratoRepository->find($id)->delete();
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }


    /**
     * Desassociar o Preposto do Contrato
     *
     * @param  int $id_contrato_preposto
     *
     * @return Response
     */
    public function disassociate_preposto($id_contrato_preposto)
    {
        try{

            $this->contratoService->disassociate_preposto($id_contrato_preposto);
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success']);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

    /**
     * Desassociar o Processo de Pagamento do Contrato
     *
     * @param  int $id_contrato_processo_pagamento
     *
     * @return Response
     */
    public function disassociate_processo_pagamento($id_contrato_processo_pagamento)
    {
        try{

            $this->contratoService->disassociate_processo_pagamento($id_contrato_processo_pagamento);
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success']);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

    /**
     * Desassociar o Fiscal do Contrato
     *
     * @param  int $id_contrato_fiscal
     *
     * @return Response
     */
    public function disassociate_fiscal($id_contrato_fiscal)
    {
        try{

            $this->contratoService->disassociate_fiscal($id_contrato_fiscal);
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success']);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

    /**
     * Desassociar a Informação Adicional do Contrato
     *
     * @param  int $id_contrato_informacao_adicional
     *
     * @return Response
     */
    public function disassociate_informacao_adicional($id_contrato_informacao_adicional)
    {
        try{

            $this->contratoService->disassociate_informacao_adicional($id_contrato_informacao_adicional);
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success']);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }
    
    /**
     * Método responsável por recuperar dados do Contrato no WebService do Dados.gov
     *
     * @param $nu_contrato String
     * @param $nu_uasg String
     * @return json
     *
     */
    public function findContratoWsByNuContratoCoUasg($nu_contrato, $nu_uasg)
    {
        return response()->json($this->contratoServiceWsService->findContratoByNuContratoCoUasg($nu_contrato, $nu_uasg));
    }

    /**
     * Método responsável por recuperar dados do Contrato no BD
     *
     * @param $nu_contrato String
     * @param $nu_uasg String
     * @return json
     *
     */
    public function findContratoBdByNuContratoCoUasg($nu_contrato, $nu_uasg)
    {
        return response()->json($this->contratoRepository->findContratoByNuContratoCoUasg($nu_contrato, $nu_uasg));
    }
    
    /**
     * Método responsável por verificar se já existe Contrato Ativo cadastrado no BD de acordo com os parametros informados
     *
     * @param $nu_contrato String
     * @param $nu_uasg String
     * @return boolean
     *
     */
    public function existsContratoByNuContratoCoUasg($nu_contrato, $nu_uasg)
    {
        $contratoBD = $this->contratoRepository->findContratoByNuContratoCoUasg($nu_contrato, $nu_uasg);
        if ($contratoBD){
            if ($contratoBD->in_status_contrato == 'EC'){
                return 2; //CONTRATO EXISTNTE, MAS ENCERRADO
            }else{
                return 1; //CONTRATO EXISTNTE E ATIVO
            }
        }else{
            return 0;
        }
    }

    /**
     * Método responsável por verificar se já existe Contrato Excluído cadastrado no BD de acordo com os parametros informados
     *
     * @param $nu_contrato String
     * @param $nu_uasg String
     * @return boolean
     *
     */
    public function existsContratoExcluidoByNuContratoCoUasg($nu_contrato, $nu_uasg)
    {
        $contratoBD = $this->contratoRepository->findContratoExcluidoByNuContratoCoUasg($nu_contrato, $nu_uasg);
        if ($contratoBD){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * Método responsável por reativar Contrato Excluído no BD de acordo com os parametros informados
     *
     * @param $nu_contrato String
     * @param $nu_uasg String
     * @return boolean
     *
     */
    public function reativarContratoExcluidoByNuContratoCoUasg($nu_contrato, $nu_uasg)
    {
        $retorno = $this->contratoRepository->restoreDeleted([['nr_contrato','=', $nu_contrato],['co_uasg', '=', $nu_uasg]]);
        return $retorno;
    }

    /**
     * Método resonsável por recuperar dados do Contrato por meio do ID para popular a Modal do Calendário
     *
     * @return Json
     */
    public function findDadosContratoCalendarioById($id)
    {   
        $dadosContrato = $this->contratoRepository->find($id);

        $html = view('gescon::_modal_Contrato', compact('dadosContrato'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);        
    }

    /**
     * Mostre o formulário para poder encerrar um contrato
     *
     */
    public function modal_encerramento($id_contrato)
    {   
        $html = view('gescon::contratos._modal_encerramento', compact('id_contrato'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }


    /**
     * Método resonsável por encerrar o Contrato por meio do seu ID
     *
     * @return Json
     */
    public function encerrar(ContratoEncerramentoRequest $request)
    {   
        $id = $request['id_contrato'];
        $request->request->add(['in_status_contrato' => 'EC']);
        $request->request->add(['nr_cpf_encerramento' => UtilHelper::getUsername()]);

        $this->contratoRepository->update($request->all(), $id);
        
        $html = $this->renderizarTabela();

        return response(['msg' => 'O Contrato foi encerrado com sucesso.', 'status' => 'success', 'html'=> $html]);   
    }

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        $fiscais = $this->contratoRepository->all();
        return view('gescon::contratos._tabela', compact('fiscais'))->render(); 
    }

    /**
     * Método responsável por receber e gravar em arquivo temporario o arquivo e-BPS do Fiscal
     * 
     * @return String {nome do arquivo}
     */
    public function gravarArquivoEbpsTemporario(Request $request)
    {
        $pasta = "arquivos_tmp/";
        if (isset($request['arquivo-ebps'])){
            
            $upload = Upload::uploadFile($request['arquivo-ebps'],'public_GESCON',$pasta);
            return response(['msg' => $upload['nome_arquivo'], 'status' => 'success']);        

        }
        return response(['msg' => '', 'status' => 'success']);        
    }

}
