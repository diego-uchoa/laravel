<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Http\Requests\PerfilRequest;

use App\Modules\Sisadm\Repositories\PerfilRepository;
use App\Modules\Sisadm\Repositories\OperacaoRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;

class PerfisController extends Controller
{
    
    protected $repository;
    protected $operacaoRepository;

    public function __construct(PerfilRepository $repository, OperacaoRepository $operacaoRepository, SistemaRepository $sistemaRepository)
    {
        $this->repository = $repository;
        $this->operacaoRepository = $operacaoRepository;
        $this->sistemaRepository = $sistemaRepository;
    }

    public function index()
    {
        $mode = "";
        $perfis = $this->repository->findAllOrderByName();
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema'); 
        return view('sisadm::perfis.index', compact('perfis', 'mode', 'sistemas'));
    }

    public function create()
    {
        $mode = "create";
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema'); 
        $html = view('sisadm::perfis._modal', compact('sistemas', 'mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function store(PerfilRequest $request)
    {
        $this->repository->create($request->all());
        $html = $this->renderizarTabela();
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);
    }

    public function edit($id)
    {
        $mode = "update";
        $perfil = $this->repository->find($id);
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');
        $html = view('sisadm::perfis._modal', compact('perfil','sistemas', 'mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function update(PerfilRequest $request, $id)
    {
        $this->repository->find($id)->update($request->all());    
        $html = $this->renderizarTabela();
        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);
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

    public function operacoes($id)
    {
        $perfil = $this->repository->find($id);
        $operacoes = $this->operacaoRepository->all();
        $operacoesPerfil = $this->repository->operacoesPerfil($id);

        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');

        return view('sisadm::perfis.operacoes', compact('perfil', 'operacoes', 'operacoesPerfil','sistemas'));
    }

    public function storeOperacoes(Request $request, $id)
    {
        $perfil = $this->repository->find($id);
        $this->repository->syncOperacoes($perfil, $request['operacoes']);
        
        return redirect()->route('sisadm::perfis.index');
    }

    public function revokeOperacoes($id, $id_operacao)
    {
        $perfil = $this->repository->find($id);
        
        $operacao = $this->operacaoRepository->find($id_operacao);
        
        $this->repository->revokeOperacoes($perfil, $operacao);

        return redirect()->back();

    }

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        //recuperando os perfis para renderizar a tabela
        $perfis = $this->repository->findAllOrderByName();                
        return view('sisadm::perfis._tabela', compact('perfis'))->render(); 
    }

}
