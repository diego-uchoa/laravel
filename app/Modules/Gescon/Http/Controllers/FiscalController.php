<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\FiscalRequest;
use App\Modules\Gescon\Repositories\FiscalRepository;
use App\Modules\Sisadm\Services\SiapeWsService;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class FiscalController extends Controller
{
    /** @var  FiscalRepository */
    private $fiscalRepository;
    private $siapeWsService;

    public function __construct(FiscalRepository $fiscalRepository, SiapeWsService $siapeWsService)
    {
        $this->fiscalRepository = $fiscalRepository;
        $this->siapeWsService = $siapeWsService;
    }

    /**
     * Exibir uma listagem do Fiscal.
     *
     */
    public function index()
    {
        $mode = "";
        $fiscais = $this->fiscalRepository->all();

        return view('gescon::fiscais.index', compact('fiscais', 'mode'));
    }

    /**
     * Recuperar os registros de Fiscais cadastrados
     *
     */
    public function records(Request $request)
    {   
        $fiscais = $this->fiscalRepository->findAllOrderByName();
        return Datatables::of($fiscais)
                
                ->addColumn('nr_cpf', function ($fiscal) {
                                return $fiscal->nr_cpf;
                            })
                ->addColumn('no_fiscal', function ($fiscal) {
                                return $fiscal->no_fiscal;
                            })
                ->addColumn('nr_siape', function ($fiscal) {
                                return $fiscal->nr_siape;
                            })

                ->addColumn('operacoes', function ($fiscal) {
                    return "<a href='#' data-url=".url('gescon/fiscais/edit/'.$fiscal->id_fiscal.'')." class='btn btn-xs btn-info update'>
                                <i class='ace-icon fa fa-pencil'></i>
                            </a>
                            <a href='#' data-id='{{ $fiscal->id_fiscal }}' data-url=".url('gescon/fiscais/destroy/'.$fiscal->id_fiscal.'')." class='btn btn-xs btn-danger delete'>
                                <i class='ace-icon fa fa-trash-o'></i>
                            </a>   ";
                            })
                ->rawColumns(['operacoes'])
                ->make(true);
    }

    /**
     * Mostre o formulário para criar um novo Fiscal.
     *
     */
    public function create()
    {   
        $mode = "create";

        $html = view('gescon::fiscais._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere um Fiscal recentemente criado.
     *
     * @param FiscalRequest $request
     *
     */
    public function store(FiscalRequest $request)
    {
        $this->fiscalRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Mostra o formulário para editar um Fiscal especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $fiscal = $this->fiscalRepository->find($id);
        
        $html = view('gescon::fiscais._modal', compact('fiscal', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um Fiscal especificado.
     *
     * @param  int $id
     * @param FiscalRequest $request
     *
     * @return Response
     */
    public function update($id, FiscalRequest $request)
    {
        $fiscal = $this->fiscalRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove um Fiscal específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->fiscalRepository->find($id)->delete();
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }




    /**
    * Método responsável por recuperar os Dados do Fiscal informado no BD, caso não encontre, será pesquisado no WS
    * @param  String $cpf
    * @return Array
    */
    public function findDadosFiscalByCPF($cpf)
    {
        $retorno = array();
        
        $fiscal = $this->fiscalRepository->findByCPF($cpf);

        if ($fiscal){
            $retorno['id_fiscal'] = $fiscal['id_fiscal'];
            $retorno['no_fiscal'] = $fiscal['no_fiscal'];
            $retorno['nr_siape'] = $fiscal['nr_siape'];
            $retorno['ds_email'] = $fiscal['ds_email'];
            $retorno['nr_telefone'] = $fiscal['nr_telefone'];
            $retorno['st_cadastrado'] = 1;
        }else{

            $dadosPessoais = $this->siapeWsService->findDadosPessoaisByCPF($cpf);
            $dadosFuncionais = $this->siapeWsService->findDadosFuncionaisByCPF($cpf);
            
            if ($dadosPessoais){
                $retorno['id_fiscal'] = "";
                $retorno['no_fiscal'] = $dadosPessoais['no_pessoa'];
                $retorno['ds_email'] = "";
                $retorno['nr_telefone'] = "";
                $retorno['st_cadastrado'] = 0;
                foreach ($dadosFuncionais as $dadoFuncional)
                {
                    if ($dadoFuncional['dt_ocorrencia_exclusao'] == "")
                    {
                        $retorno['nr_siape'] = $dadoFuncional['nr_siape'];
                    }
                }    
            }
        }

        return $retorno;

    }


    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        $fiscais = $this->fiscalRepository->all();
        return view('gescon::fiscais._tabela', compact('fiscais'))->render(); 
    }
}
