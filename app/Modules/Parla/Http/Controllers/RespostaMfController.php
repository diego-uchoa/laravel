<?php

namespace App\Modules\Parla\Http\Controllers;

use App\Modules\Parla\Http\Requests\RespostaMfRequest;
use App\Modules\Parla\Repositories\RespostaMfRepository;
use App\Http\Controllers\Controller;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Modules\Parla\Repositories\TipoPosicaoRepository;
use App\Modules\Parla\Repositories\ProposicaoRepository;
use Storage;
use Carbon\Carbon;
use App\Http\Upload;
use PDF;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class RespostaMfController extends Controller
{
    /** @var  RespostaMfRepository */
    private $respostaMfRepository;
    protected $orgaoRepository;
    protected $tipoPosicaoRepository;
    protected $proposicaoRepository;
    const SISTEMA = "PARLA";

    public function __construct(RespostaMfRepository $respostaMfRepository, OrgaoRepository $orgaoRepository, TipoPosicaoRepository $tipoPosicaoRepository, ProposicaoRepository $proposicaoRepository)
    {
        $this->respostaMfRepository = $respostaMfRepository;
        $this->orgaoRepository = $orgaoRepository;
        $this->tipoPosicaoRepository = $tipoPosicaoRepository;
        $this->proposicaoRepository = $proposicaoRepository;
    }

    /**
     * Exibir uma listagem do RespostaMf.
     *
     */
    public function index()
    {
        $mode = "";
        $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
        $listaTiposPosicao = $this->tipoPosicaoRepository->preparaListaTiposPosicao();

        return view('parla::respostas_mf.index', compact('mode','listaProposicoes','listaOrgaos','listaTiposPosicao'));
    }

    /**
     * Gera a datatable de respostas
     *
     * @param Request $request
     */
    public function list(Request $request)
    {
        $respostasMf = $this->respostaMfRepository->all();

        $canEdit = false;
        $canDestroy = false;
        if(\Entrust::can('parla::respostas_mf.edit')) {
            $canEdit = true;
        }

        if(\Entrust::can('parla::respostas_mf.destroy')) {
            $canDestroy = true;
        }
        
        return Datatables::of($respostasMf)->with($canEdit,$canDestroy)
            ->addColumn('proposicao', function ($respostaMf) {
                if($respostaMf->proposicao->sn_possui_revisora)
                    return '<a origem="'.$respostaMf->proposicao->origem.'" href="'.route('parla::proposicoes.show',['id'=>$respostaMf->proposicao->id_proposicao]).'">'.$respostaMf->proposicao->origem.' - '.$respostaMf->proposicao->revisora.'</a>';
                else
                    return '<a origem="'.$respostaMf->proposicao->origem.'" href="'.route('parla::proposicoes.show',['id'=>$respostaMf->proposicao->id_proposicao]).'">'.$respostaMf->proposicao->origem.'</a>';
            })
            ->addColumn('dt_envio', function ($respostaMf) {
                return $respostaMf->dt_envio;
            })
            ->addColumn('tx_tipo_posicao', function ($respostaMf) {
                return $respostaMf->tipoPosicao->tx_tipo_posicao;
            })            
            ->addColumn('sg_orgao', function ($respostaMf) {
                return $respostaMf->orgao->sg_orgao;
            })
            ->addColumn('documento', function ($respostaMf) {
                if($respostaMf->tx_arquivo)
                    return '<a href="/uploads/parla/respostas/'.$respostaMf->tx_arquivo.'"><span><i class="fa fa-download" aria-hidden="true"></i> '.$respostaMf->no_documento.'</span></a>';
                else {
                    return $respostaMf->no_documento;
                }
                return $respostaMf->orgao->sg_orgao;
            })
            ->addColumn('tx_descricao', function ($respostaMf) {
                return $respostaMf->tx_descricao;
            })
            ->addColumn('acoes', function ($respostaMf) use ($canEdit, $canDestroy){
                $retornoEdit = "";
                $retornoDestroy = "";
                
                if($canEdit) {
                    $retornoEdit = '<a href="#" data-url="'.route('parla::respostas_mf.edit',['id'=>$respostaMf->id_resposta_mf]).'" class="btn btn-xs btn-info update" data-rel="tooltip" data-original-title="Editar"><i class="ace-icon fa fa-pencil"></i></a>';
                }

                if($canDestroy) {
                    $retornoDestroy = '<a href="#" data-id="'.$respostaMf->id_resposta_mf.'" class="btn btn-xs btn-danger delete" data-url="'.route('parla::respostas_mf.destroy',['id'=>$respostaMf->id_resposta_mf]).'" data-rel="tooltip" data-original-title="Excluir"><i class="ace-icon fa fa-trash-o"></i></a>';
                }
                
                return $retornoEdit.' '.$retornoDestroy;
            })
            ->rawColumns(['proposicao','documento','acoes'])
            ->make(true);
    }

    /**
     * Mostre o formulário para criar um novo RespostaMf.
     *
     */
    public function create($id_proposicao = null)
    {   
        $mode = "create";
        $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
        $listaTiposPosicao = $this->tipoPosicaoRepository->preparaListaTiposPosicao();

        $html = view('parla::respostas_mf._modal', compact('id_proposicao','mode','listaProposicoes','listaOrgaos','listaTiposPosicao'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere um RespostaMf recentemente criado.
     *
     * @param RespostaMfRequest $request
     *
     */
    public function store(RespostaMfRequest $request, $id_proposicao = null)
    {

        if ($request->hasFile('resposta')) {

            $upload = Upload::uploadFile($request['resposta'],'storage_PARLA','respostas');
            $request['tx_arquivo'] = $upload['nome_arquivo'];

        }

        $this->respostaMfRepository->create($request->all());

        $html = $this->renderizarTabela($id_proposicao);
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Mostra o formulário para editar um RespostaMf especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id, $id_proposicao = null)
    {
        $mode = "update";
        $respostaMf = $this->respostaMfRepository->find($id);
        $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
        $listaTiposPosicao = $this->tipoPosicaoRepository->preparaListaTiposPosicao();
        
        $html = view('parla::respostas_mf._modal', compact('id_proposicao','respostaMf', 'mode','listaProposicoes','listaOrgaos','listaTiposPosicao'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um RespostaMf especificado.
     *
     * @param  int $id
     * @param RespostaMfRequest $request
     *
     * @return Response
     */
    public function update($id, RespostaMfRequest $request, $id_proposicao = null)
    {
        if($request['arquivo_delete'] == 'true' && $request->hasFile('resposta') == false){
            $request['tx_arquivo'] = '';
        }else {
            $request['tx_arquivo'] = $request['arquivo_atual'];
        }

        if ($request->hasFile('resposta')) {

            $upload = Upload::uploadFile($request['resposta'],'storage_PARLA','respostas');
            $request['tx_arquivo'] = $upload['nome_arquivo'];

        }

        $respostaMf = $this->respostaMfRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela($id_proposicao);

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove um RespostaMf específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, $id_proposicao = null)
    {
        try{

            $this->respostaMfRepository->find($id)->delete();
            $html = $this->renderizarTabela($id_proposicao);
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }


    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela($id_proposicao = null)
    {
        if($id_proposicao == null) {
            $respostasMf = $this->respostaMfRepository->all();
            return view('parla::respostas_mf._tabela', compact('respostasMf'))->render(); 
        }
        else {
            $mode = "";
            $proposicao = $this->proposicaoRepository->find($id_proposicao);
            $id_proposicao = $proposicao->id_proposicao;
            $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
            $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
            $listaTiposPosicao = $this->tipoPosicaoRepository->preparaListaTiposPosicao();
            return view('parla::respostas_mf._tabela', compact('id_proposicao','proposicao','mode','listaProposicoes','listaOrgaos','listaTiposPosicao'))->render();
        }
    }
}
