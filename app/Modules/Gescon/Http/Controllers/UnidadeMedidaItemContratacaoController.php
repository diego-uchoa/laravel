<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\UnidadeMedidaItemContratacaoRequest;
use App\Modules\Gescon\Repositories\UnidadeMedidaItemContratacaoRepository;
use App\Modules\Gescon\Enum\ObjetoContrato;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class UnidadeMedidaItemContratacaoController extends Controller
{
    /** @var  UnidadeMedidaItemContratacaoRepository */
    private $unidadeMedidaItemContratacaoRepository;

    public function __construct(UnidadeMedidaItemContratacaoRepository $unidadeMedidaItemContratacaoRepository)
    {
        $this->unidadeMedidaItemContratacaoRepository = $unidadeMedidaItemContratacaoRepository;
    }

    /**
     * Exibir uma listagem do UnidadeMedidaItemContratacao.
     *
     */
    public function index()
    {
        $mode = "";
        $unidadesMedidaItemContratacao = $this->unidadeMedidaItemContratacaoRepository->all();
        $listaObjeto = ObjetoContrato::getConstants();

        return view('gescon::unidades_medida_item_contratacao.index', compact('unidadesMedidaItemContratacao', 'mode', 'listaObjeto'));
    }

    /**
     * Recuperar os registros de Unidades de Medida de Itens de Contratação cadastrados
     *
     */
    public function records(Request $request)
    {   
        $unidades = $this->unidadeMedidaItemContratacaoRepository->findAllOrderByObjeto();
        return Datatables::of($unidades)
                
                ->addColumn('in_objeto', function ($unidade) {
                                return $unidade->tipoObjeto();
                            })
                ->addColumn('ds_unidade_medida_item_contratacao', function ($unidade) {
                                return $unidade->ds_unidade_medida_item_contratacao;
                            })
                ->addColumn('sg_unidade_medida_item_contratacao', function ($unidade) {
                                return $unidade->sg_unidade_medida_item_contratacao;
                            })

                ->addColumn('operacoes', function ($unidade) {
                    return "<a href='#' data-url=".url('gescon/unidades-medida-item-contratacao/edit/'.$unidade->id_unidade_medida_item_contratacao.'')." class='btn btn-xs btn-info update'>
                                <i class='ace-icon fa fa-pencil'></i>
                            </a>
                            <a href='#' data-id='{{ $unidade->id_unidade_medida_item_contratacao }}' data-url=".url('gescon/unidades-medida-item-contratacao/destroy/'.$unidade->id_unidade_medida_item_contratacao.'')." class='btn btn-xs btn-danger delete'>
                                <i class='ace-icon fa fa-trash-o'></i>
                            </a>   ";
                            })
                ->rawColumns(['operacoes'])
                ->make(true);
    }

    /**
     * Mostre o formulário para criar um novo UnidadeMedidaItemContratacao.
     *
     */
    public function create()
    {   
        $mode = "create";
        $listaObjeto = ObjetoContrato::getConstants();

        $html = view('gescon::unidades_medida_item_contratacao._modal', compact('mode', 'listaObjeto'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere um UnidadeMedidaItemContratacao recentemente criado.
     *
     * @param UnidadeMedidaItemContratacaoRequest $request
     *
     */
    public function store(UnidadeMedidaItemContratacaoRequest $request)
    {

        $this->unidadeMedidaItemContratacaoRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Mostra o formulário para editar um UnidadeMedidaItemContratacao especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $unidadeMedidaItemContratacao = $this->unidadeMedidaItemContratacaoRepository->find($id);
        $listaObjeto = ObjetoContrato::getConstants();
        $ds_objeto = ObjetoContrato::getValue($unidadeMedidaItemContratacao->in_objeto);
        
        $html = view('gescon::unidades_medida_item_contratacao._modal', compact('ds_objeto', 'unidadeMedidaItemContratacao', 'mode', 'listaObjeto'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um UnidadeMedidaItemContratacao especificado.
     *
     * @param  int $id
     * @param UnidadeMedidaItemContratacaoRequest $request
     *
     * @return Response
     */
    public function update($id, UnidadeMedidaItemContratacaoRequest $request)
    {
        $unidadeMedidaItemContratacao = $this->unidadeMedidaItemContratacaoRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove um UnidadeMedidaItemContratacao específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->unidadeMedidaItemContratacaoRepository->find($id)->delete();
            $html = $this->renderizarTabela();
            
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
    private function renderizarTabela()
    {
        $unidadesMedidaItemContratacao = $this->unidadeMedidaItemContratacaoRepository->all();
        return view('gescon::unidades_medida_item_contratacao._tabela', compact('unidadesMedidaItemContratacao'))->render(); 
    }
}
