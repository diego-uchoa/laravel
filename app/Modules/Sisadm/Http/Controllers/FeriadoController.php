<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Http\Requests\FeriadoRequest;

use App\Modules\Sisadm\Repositories\FeriadoRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FeriadoController extends Controller
{
    
    protected $repository;
    
    public function __construct(FeriadoRepository $repository)
    {
        $this->repository = $repository;        
    }

    public function index()
    {
        $mode = "";
        $feriados = $this->repository->all();

        return view('sisadm::feriado.index', compact('feriados', 'mode'));
    }

    public function create()
    {
        $mode = "create";
        $html = view('sisadm::feriado._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function store(FeriadoRequest $request)
    {
        $this->repository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    
    }

    public function edit($id)
    {
        $mode = "update";
        $feriado = $this->repository->find($id);
        
        $html = view('sisadm::feriado._modal', compact('feriado', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    public function update(FeriadoRequest $request, $id)
    {
        $feriado = $this->repository->find($id)->update($request->all());
        
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
        //recuperando os Feriados para renderizar a tabela
        $feriados = $this->repository->findAllOrderByName();                
        return view('sisadm::feriado._tabela', compact('feriados'))->render(); 
    }    
}