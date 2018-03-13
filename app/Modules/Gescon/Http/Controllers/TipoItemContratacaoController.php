<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\TipoItemContratacaoRequest;
use App\Modules\Gescon\Repositories\TipoItemContratacaoRepository;
use App\Modules\Gescon\Enum\ObjetoContrato;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class TipoItemContratacaoController extends Controller
{
    /** @var  TipoItemContratacaoRepository */
    private $tipoItemContratacaoRepository;

    public function __construct(TipoItemContratacaoRepository $tipoItemContratacaoRepository)
    {
        $this->tipoItemContratacaoRepository = $tipoItemContratacaoRepository;
    }

    /**
     * Exibir uma listagem do TipoItemContratacao.
     *
     */
    public function index()
    {
        $mode = "";
        $tiposItensContratacao = $this->tipoItemContratacaoRepository->all();
        $listaObjeto = ObjetoContrato::getConstants();
        
        return view('gescon::tipos_itens_contratacao.index', compact('tiposItensContratacao', 'mode', 'listaObjeto'));
    }

    /**
     * Recuperar os registros de Tipos de Itens de Contratação cadastrados
     *
     */
    public function records(Request $request)
    {   
        $tipos = $this->tipoItemContratacaoRepository->findAllOrderByObjeto();
        return Datatables::of($tipos)
                
                ->addColumn('in_objeto', function ($tipo) {
                                return $tipo->tipoObjeto();
                            })
                ->addColumn('ds_tipo_item_contratacao', function ($tipo) {
                                return $tipo->ds_tipo_item_contratacao;
                            })

                ->addColumn('operacoes', function ($tipo) {
                    return "<a href='#' data-url=".url('gescon/tipos-itens-contratacao/edit/'.$tipo->id_tipo_item_contratacao.'')." class='btn btn-xs btn-info update'>
                                <i class='ace-icon fa fa-pencil'></i>
                            </a>
                            <a href='#' data-id='{{ $tipo->id_tipo_item_contratacao }}' data-url=".url('gescon/tipos-itens-contratacao/destroy/'.$tipo->id_tipo_item_contratacao.'')." class='btn btn-xs btn-danger delete'>
                                <i class='ace-icon fa fa-trash-o'></i>
                            </a>   ";
                            })
                ->rawColumns(['operacoes'])
                ->make(true);
    }

    /**
     * Mostre o formulário para criar um novo TipoItemContratacao.
     *
     */
    public function create()
    {   
        $mode = "create";
        $listaObjeto = ObjetoContrato::getConstants();

        $html = view('gescon::tipos_itens_contratacao._modal', compact('mode', 'listaObjeto'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere um TipoItemContratacao recentemente criado.
     *
     * @param TipoItemContratacaoRequest $request
     *
     */
    public function store(TipoItemContratacaoRequest $request)
    {
        if ($this->verifica_tipo_contratacao($request['in_objeto'], $request['ds_tipo_item_contratacao'])){

            return response(['msg' => trans('alerts.registro.createdError'), 'detail' => ' O Objeto de Contratação informado já existe.', 'status' => 'error']);    

        }else{

            $this->tipoItemContratacaoRepository->create($request->all());

            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

        }
    }

    /**
     * Verifica se já existe um cadastro com o mesmo nome
     *
     * @param String $in_objeto
     * @param String $tipo_contratacao
     *
     */
    private function verifica_tipo_contratacao($in_objeto, $tipo_contratacao)
    {
        $registro = $this->tipoItemContratacaoRepository->findBy([['in_objeto', '=', $in_objeto], ['ds_tipo_item_contratacao', '=', $tipo_contratacao]]);
        if (count($registro) > 0){
            return true;   
        }   
        return false;
    }

    /**
     * Mostra o formulário para editar um TipoItemContratacao especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $tipoItemContratacao = $this->tipoItemContratacaoRepository->find($id);
        $listaObjeto = ObjetoContrato::getConstants();
        $ds_objeto = ObjetoContrato::getValue($tipoItemContratacao->in_objeto);
        
        $html = view('gescon::tipos_itens_contratacao._modal', compact('ds_objeto', 'tipoItemContratacao', 'mode', 'listaObjeto'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um TipoItemContratacao especificado.
     *
     * @param  int $id
     * @param TipoItemContratacaoRequest $request
     *
     * @return Response
     */
    public function update($id, TipoItemContratacaoRequest $request)
    {
        $tipoItemContratacao = $this->tipoItemContratacaoRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove um TipoItemContratacao específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->tipoItemContratacaoRepository->find($id)->delete();
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

    /**
     * Método responsável por listar todos os Tipos de Itens de Contratação relacionados ao objeto do Contrato informado e que atendam o parametro informado para preencher uma Combo (Select)
     * 
     * @return Json
     */
    public function listTipoItemContratacaoByNomeObjeto($objeto, Request $request)
    {
        $listaTipoItemContratacao = $this->tipoItemContratacaoRepository->prepareListaSelect2ByNome($request["parametro"], $objeto);
        return $listaTipoItemContratacao;
    }       


    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        $tiposItensContratacao = $this->tipoItemContratacaoRepository->all();
        return view('gescon::tipos_itens_contratacao._tabela', compact('tiposItensContratacao'))->render(); 
    }
}
