<?php

namespace App\Modules\Sisadm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Modules\Sisadm\Http\Requests\OrgaoRequest;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Http\Controllers\Controller;
use App\Modules\Sisadm\Services\SiapeOrgaoWsService;
use Illuminate\Support\Facades\DB;

class OrgaoController extends Controller
{
    /** @var  OrgaoRepository */
    private $orgaoRepository;
    private $orgaoService;

    public function __construct(OrgaoRepository $orgaoRepository, 
                                    SiapeOrgaoWsService $orgaoService)
    {
        $this->orgaoRepository = $orgaoRepository;
        $this->orgaoService = $orgaoService;
    }

    /**
     * Exibir uma listagem do Orgao.
     *
     */
    public function index()
    {
        $mode = "";
        $orgaos = $this->orgaoRepository->all();

        return view('sisadm::orgaos.index', compact('orgaos', 'mode'));
    }

    /**
     * Mostre o formulário para criar um novo Orgao.
     *
     */
    public function create()
    {   
        $mode = "create";

        $html = view('sisadm::orgaos._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere um Orgao recentemente criado.
     *
     * @param OrgaoRequest $request
     *
     */
    public function store(OrgaoRequest $request)
    {

        $this->orgaoRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Mostra o formulário para editar um Orgao especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $orgao = $this->orgaoRepository->find($id);
        
        $html = view('sisadm::orgaos._modal', compact('orgao', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um Orgao especificado.
     *
     * @param  int $id
     * @param OrgaoRequest $request
     *
     * @return Response
     */
    public function update($id, OrgaoRequest $request)
    {
        $orgao = $this->orgaoRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove um Orgao específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->orgaoRepository->find($id)->delete();
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
        $orgaos = $this->orgaoRepository->all();
        return view('sisadm::orgaos._tabela', compact('orgaos'))->render(); 
    }


    /**
     * Método responsável por listar todos os Órgãos que atendam o parametro informado para preencher uma Combo (Select)
     * 
     * @return Json
     */
    public function listOrgaosByNomeSigla(Request $request)
    {
        $listaOrgaos = $this->orgaoRepository->prepareListaSelect2BySiglaNome($request["parametro"]);
        return $listaOrgaos;
    }   

    /**
     * Método responsável por listar todos os Órgãos relacionados ao Sistema e que atendam o parametro informado para preencher uma Combo (Select)
     * 
     * @return Json
     */
    public function listOrgaosByNomeSiglaSistema($sistema, Request $request)
    {
        $listaOrgaos = $this->orgaoRepository->prepareListaSelect2BySiglaNome($request["parametro"], $sistema);
        return $listaOrgaos;
    }   


    /**
     * Método responsável por recuperar do WS e gravar no BD os Órgãos da Tabela de Importação 
     * @param 
     * @return Json
     */
    public function findOrgaoByCodigoUorgWS()
    {
        $orgaos = DB::table('spoa_portal.orgao_importacao')->get();

        foreach ($orgaos as $orgao) {
            
            $orgaoWS = $this->orgaoService->storeOrgaoByCodigo(substr($orgao->co_orgao_siorg,-6));
            
        }
        
        echo "Finalizado";
        exit;
    } 

    /**
     * Método responsável por recuperar do BD o Órgão com o Código SIAFI informado
     * @param 
     * @return Json
     */
    public function findOrgaoByCodigoSiafi($request)
    {
        try{
       
            $orgao = $this->orgaoRepository->findByCodigoSiafi($request);
            return $orgao;    

        }catch(Exception $e){
            
            return response(['msg' => $e->getMessage(), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }
        
    } 
}