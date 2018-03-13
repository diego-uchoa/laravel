<?php

namespace App\Modules\Parla\Http\Controllers;

use App\Modules\Parla\Http\Requests\ProposicaoRequest;
use App\Modules\Parla\Http\Requests\ObservacaoRequest;
use App\Modules\Parla\Repositories\ProposicaoRepository;
use App\Modules\Parla\Repositories\TipoProposicaoRepository;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Modules\Parla\Repositories\TipoConsultaRepository;
use App\Modules\Parla\Repositories\TipoPosicaoRepository;
use App\Modules\Parla\Repositories\ComissaoRepository;
use App\Modules\Parla\Repositories\ConsultaMfRepository;
use App\Modules\Parla\Repositories\RespostaMfRepository;
use App\Modules\Parla\Services\ProposicaoService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;

class ProposicaoController extends Controller
{
    /** @var  ProposicaoRepository */
    private $proposicaoRepository;
    private $proposicaoService;
    private $tipoProposicaoRepository;
    private $orgaoRepository;
    private $tipoConsultaRepository;
    private $tipoPosicaoRepository;
    private $consultaMfRepository;
    private $respostaMfRepository;
    private $comissaoRepository;
    const SISTEMA = "PARLA";

    public function __construct(ProposicaoRepository $proposicaoRepository, ProposicaoService $proposicaoService, TipoProposicaoRepository $tipoProposicaoRepository, 
        OrgaoRepository $orgaoRepository, TipoConsultaRepository $tipoConsultaRepository, TipoPosicaoRepository $tipoPosicaoRepository, ConsultaMfRepository $consultaMfRepository,
        RespostaMfRepository $respostaMfRepository, ComissaoRepository $comissaoRepository)
    {
        $this->proposicaoRepository = $proposicaoRepository;
        $this->proposicaoService = $proposicaoService;
        $this->tipoProposicaoRepository = $tipoProposicaoRepository;
        $this->orgaoRepository = $orgaoRepository;
        $this->tipoConsultaRepository = $tipoConsultaRepository;
        $this->tipoPosicaoRepository = $tipoPosicaoRepository;
        $this->consultaMfRepository = $consultaMfRepository;
        $this->respostaMfRepository = $respostaMfRepository;
        $this->comissaoRepository = $comissaoRepository;
    }

    /**
     * Display a listing of the Proposicao.
     *
     * @param Request $request
     */
    public function index()
    {
        return view('parla::proposicoes.index');
    }

    /**
     * Gera a datatable de proposicoes
     *
     * @param Request $request
     */
    public function list(Request $request)
    {
        $proposicoes = $this->proposicaoRepository->all();

        $canDestroy = false;

        if(\Entrust::can('parla::proposicoes.destroy')) {
            $canDestroy = true;
        }
        
        return Datatables::of($proposicoes)->with($canDestroy)
            ->addColumn('origem', function ($proposicao) {
                return '<a origem="'.$proposicao->sg_casa_origem.' - '.$proposicao->origem.'" href="'.route('parla::proposicoes.show',['id'=>$proposicao->id_proposicao]).'">'.$proposicao->sg_casa_origem.' - '.$proposicao->origem.'</a>';
            })
            ->addColumn('revisora', function ($proposicao) {
                return $proposicao->sn_possui_revisora ? $proposicao->sg_casa_revisora.' - '.$proposicao->revisora : '';
            })
            ->addColumn('autoria', function ($proposicao) {
                return $proposicao->autoria->no_nome_autor;
            })
            ->addColumn('ementa', function ($proposicao) {
                return \Illuminate\Support\Str::words($proposicao->tx_ementa,40,' ...');
            })
            ->addColumn('palavras_chave', function ($proposicao) {
                return \Illuminate\Support\Str::words($proposicao->tx_palavra_chave,10,' ...');
            })

            ->addColumn('acoes', function ($proposicao) use ($canDestroy) {
                $retorno = '<a href="'.route('parla::proposicoes.show',['id'=>$proposicao->id_proposicao]).'" class="btn btn-xs btn-success" data-rel="tooltip" data-original-title="Ver detalhes"><i class="ace-icon fa fa-eye"></i></a>';
                
                if($canDestroy) {
                    return $retorno.'
                            <a href="#" data-id="'.$proposicao->id_proposicao.'" class="btn btn-xs btn-danger delete" data-url="'.route('parla::proposicoes.destroy',['id'=>$proposicao->id_proposicao]).'" data-rel="tooltip" data-original-title="Excluir"><i class="ace-icon fa fa-trash-o"></i></a>';
                }
                else {
                    return $retorno;
                }
            })
            ->rawColumns(['origem','acoes'])
            ->make(true);
    }

    /**
     * Display a listing of the Proposicao.
     *
     * @param Request $request
     */
    public function show($id)
    {
        try{
                    
            $mode = "";
            $proposicao = $this->proposicaoService->show($id);
            $id_proposicao = $proposicao->id_proposicao;
            $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
            $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
            $listaComissoes = $this->comissaoRepository->preparaListaComissoes();
            $listaTiposConsulta = $this->tipoConsultaRepository->preparaListaTiposConsulta();
            $listaTiposPosicao = $this->tipoPosicaoRepository->preparaListaTiposPosicao();
            
            return view('parla::proposicoes.show', compact('id_proposicao','proposicao','mode','listaProposicoes','listaOrgaos','listaComissoes','listaTiposConsulta','listaTiposPosicao'));

        }catch(Exception $e){

            return redirect()->route('parla::proposicoes.index')->with('exception', $e->getMessage());

        }
    }

    /**
     * Show the form for creating a new Proposicao.
     *
     */
    public function create()
    {   
        $mode="create";
        $listaTiposProposicao = $this->tipoProposicaoRepository->preparaListaTiposProposicao();
        $html = view('parla::proposicoes._modal', compact('listaTiposProposicao','mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Store a newly created Proposicao in storage.
     *
     * @param CreateProposicaoRequest $request
     *
     */
    public function store(ProposicaoRequest $request)
    {
        $proposicao = array(
            'sg_casa' => substr($request['sg_tipo'],0,2), 
            'sg_sigla' => substr($request['sg_tipo'], 2), 
            'nr_numero' => $request['nr_numero'], 
            'an_ano' => $request['an_ano'] 
        );

    	try{
        
            $returnStore = $this->proposicaoService->store($proposicao);

            if($returnStore['status'] == 'success') {
                return response(['msg' => $returnStore['msg'], 'status' => 'success', 'redirect_url' => route('parla::proposicoes.show',['id'=>$returnStore['id']])]);
            }
            else {
                return response(['msg' => $returnStore['msg'], 'status' => 'error']);
            }
            
        }catch (Exception $e){

            return response(['msg' => $e->getMessage(), 'status' => 'error']);

        }
    }

    /**
     * Show the form for editing the specified Proposicao.
     *
     * @param  int $id
     *
     */
    public function editObservacao($id)
    {
        $proposicao = $this->proposicaoRepository->find($id);
        $mode = "update";

        $html = view('parla::proposicoes.observacoes._modal', compact('proposicao','mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Update the specified Proposicao in storage.
     *
     * @param  int              $id
     * @param UpdateProposicaoRequest $request
     *
     * @return Response
     */
    public function updateObservacao($id, Request $request) {
            $this->proposicaoRepository->find($id)->update(array('tx_observacao' => $request->input('tx_observacao')));

            $proposicao = $this->proposicaoRepository->find($id);

            $html = view('parla::proposicoes.show._dados_proposicao', compact('proposicao'))->render();

            return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);  
    }

    /**
     * Show the form for editing the specified Proposicao.
     *
     * @param  int $id
     *
     */
    public function editPrioritario($id)
    {
        $proposicao = $this->proposicaoRepository->find($id);
        $mode = "update";

        $html = view('parla::proposicoes.prioritario._modal', compact('proposicao','mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Update the specified Proposicao in storage.
     *
     * @param  int              $id
     * @param UpdateProposicaoRequest $request
     *
     * @return Response
     */
    public function updatePrioritario($id, Request $request) {
            $this->proposicaoRepository->find($id)->update(array('nr_prioritario' => $request->input('nr_prioritario')));

            $proposicao = $this->proposicaoRepository->find($id);

            $html = view('parla::proposicoes.show._dados_proposicao', compact('proposicao'))->render();

            return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);  
    }


    /**
     * Remove the specified Proposicao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->proposicaoRepository->find($id)->delete();
            $this->consultaMfRepository->deleteBy([['id_proposicao','=',$id]]);
            $this->respostaMfRepository->deleteBy([['id_proposicao','=',$id]]);
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }

    public function getPrioritario($id) {
        return $this->proposicaoRepository->find($id)->nr_prioritario;
    }


    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        //recuperando os sistemas para renderizar a tabela
        $proposicoes = $this->proposicaoRepository->all();
        return view('parla::proposicoes._tabela', compact('proposicoes'))->render(); 
    }
}
