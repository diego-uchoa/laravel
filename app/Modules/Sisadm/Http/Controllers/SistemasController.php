<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Http\Requests\SistemaRequest;
use App\Modules\Sisadm\Http\Requests\OrgaoSistemaRequest;
use App\Modules\Sisadm\Repositories\SistemaRepository;
use App\Modules\Sisadm\Repositories\AreaRepository;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Http\Controllers\Controller;

class SistemasController extends Controller
{

    protected $repository;
    protected $areaRepository;
    protected $orgaoRepository;

    public function __construct(SistemaRepository $repository, AreaRepository $areaRepository, OrgaoRepository $orgaoRepository)
    {
        $this->repository = $repository;
        $this->areaRepository = $areaRepository;
        $this->orgaoRepository = $orgaoRepository;
    }

	public function index()
    {
        $sistemas = $this->repository->findAllOrderByName();
        $areasLists = $this->areaRepository->lists('no_area','id_area'); 
        
        return view('sisadm::sistemas.index', compact('sistemas','areasLists'));
    }

    public function create()
    {
    	$areas = $this->areaRepository->all();
        $areasLists = $this->areaRepository->lists('no_area','id_area'); 
        
        return view('sisadm::sistemas.create',compact('areas','areasLists'));
    }

    public function store(SistemaRequest $request)
    {
        $this->repository->create($request->all());
        
        return redirect()->route('sisadm::sistemas.index')->with('message', trans('alerts.registro.created'));
    }

    public function edit($id)
    {
        $sistema =  $this->repository->find($id);
        $areas = $this->areaRepository->all();
        $areasLists = $this->areaRepository->lists('no_area','id_area'); 
            
        return view('sisadm::sistemas.edit', compact('sistema','areas','areasLists'));
    }

    public function update(SistemaRequest $request, $id)
    {
        try{
            
            $this->repository->find($id)->update($request->all());
            return redirect()->route('sisadm::sistemas.index')->with('message', trans('alerts.registro.updated'));    

        }catch(\Exception $e){
            
            $messagesExceptions = [
               'exception' => 'Erro '. $e->getCode() .' : ', 
               'message_exception' => $e->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions, $e->getCode());

        }
        
    }

    public function destroy($id)
    {
        try{

            $this->repository->find($id)->delete();
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }

    }

    /**
     * Método responsável por exibir os orgaos utilizados pelo sistema
     * 
     * @return View
     */
    public function orgaos($id_sistema)
    {
        $mode = '';
        $orgaos = $this->repository->getOrgaosBySistema($id_sistema);
        $sistema = $this->repository->find($id_sistema);
        $listaOrgaos = [];

        
        return view('sisadm::sistemas.orgaos.index', compact('id_sistema','orgaos','sistema','mode','listaOrgaos'));
    }

    public function createOrgao($id_sistema)
    {
        $listaOrgaos = $this->orgaoRepository->prepareListaSelect2All();
        $mode="create";

        $html = view('sisadm::sistemas.orgaos._modal', compact('id_sistema','listaOrgaos','mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function storeOrgao(OrgaoSistemaRequest $request)
    {
        $this->repository->setOrgaoBySistema($request->id_sistema, $request->id_orgao);
        $id_sistema = $request->id_sistema;

        $orgaos = $this->repository->getOrgaosBySistema($id_sistema);
        $sistema = $this->repository->find($id_sistema);
        $html = view('sisadm::sistemas.orgaos._tabela', compact('orgaos','sistema','id_sistema'))->render();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);
    } 

    /**
     * Método responsável por excluir um órgão do sistema
     * 
     * @return View
     */
    public function destroyOrgao($id_sistema, $id_orgao)
    {
        try {
            $this->repository->deleteOrgaoBySistema($id_sistema,$id_orgao);

            $orgaos = $this->repository->getOrgaosBySistema($id_sistema);
            $sistema = $this->repository->find($id_sistema);
            $html = view('sisadm::sistemas.orgaos._tabela', compact('orgaos','sistema'))->render();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        } catch(Exception $e){
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
        //recuperando os sistemas para renderizar a tabela
        $sistemas = $this->repository->findAllOrderByName();
        return view('sisadm::sistemas._tabela', compact('sistemas'))->render(); 
    }

}
