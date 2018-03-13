<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Http\Requests\OperacaoRequest;

use App\Modules\Sisadm\Repositories\OperacaoRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OperacoesController extends Controller
{
    
    protected $repository;
    protected $sistemaRepository;
    
    public function __construct(OperacaoRepository $repository, SistemaRepository $sistemaRepository)
    {
        $this->repository = $repository;        
        $this->sistemaRepository = $sistemaRepository;
    }

    public function index()
    {
        $mode = "";
        $operacoes = $this->repository->findAllOrderByName();                

        return view('sisadm::operacoes.index', compact('operacoes', 'mode'));
    }

    public function create()
    {
        $mode = "create";
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');
        $html = view('sisadm::operacoes._modal', compact('sistemas', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function store(OperacaoRequest $request)
    {
        $this->repository->create($request->all());
        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);
    }

    public function edit($id)
    {
        $mode = "update";
        $operacao = $this->repository->find($id);
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');
        $html = view('sisadm::operacoes._modal', compact('operacao','sistemas', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function update(OperacaoRequest $request, $id)
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

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        //recuperando as operacoes para renderizar a tabela
        $operacoes = $this->repository->findAllOrderByName();                
        return view('sisadm::operacoes._tabela', compact('operacoes'))->render(); 
    }

}