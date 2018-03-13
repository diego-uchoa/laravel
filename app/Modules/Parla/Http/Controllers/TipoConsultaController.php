<?php

namespace App\Modules\Parla\Http\Controllers;

use App\Modules\Parla\Http\Requests\TipoConsultaRequest;
use App\Modules\Parla\Repositories\TipoConsultaRepository;
use App\Http\Controllers\Controller;

class TipoConsultaController extends Controller
{
    /** @var  TipoConsultaRepository */
    private $tipoConsultaRepository;

    public function __construct(TipoConsultaRepository $tipoConsultaRepository)
    {
        $this->tipoConsultaRepository = $tipoConsultaRepository;
    }

    /**
     * Display a listing of the TipoConsulta.
     *
     * @param Request $request
     */
    public function index()
    {
        $mode = "";
        $tiposConsulta = $this->tipoConsultaRepository->all();

        return view('parla::tipos_consulta.index', compact('tiposConsulta', 'mode'));
    }

    /**
     * Show the form for creating a new TipoConsulta.
     *
     */
    public function create()
    {   
        $mode = "create";

        $html = view('parla::tipos_consulta._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Store a newly created TipoConsulta in storage.
     *
     * @param CreateTipoConsultaRequest $request
     *
     */
    public function store(TipoConsultaRequest $request)
    {

        $this->tipoConsultaRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Show the form for editing the specified TipoConsulta.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $tipoConsulta = $this->tipoConsultaRepository->find($id);
        
        $html = view('parla::tipos_consulta._modal', compact('tipoConsulta', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Update the specified TipoConsulta in storage.
     *
     * @param  int              $id
     * @param UpdateTipoConsultaRequest $request
     *
     * @return Response
     */
    public function update($id, TipoConsultaRequest $request)
    {
        $tipoConsulta = $this->tipoConsultaRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove the specified TipoConsulta from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->tipoConsultaRepository->find($id)->delete();
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
        //recuperando os sistemas para renderizar a tabela
        $tiposConsulta = $this->tipoConsultaRepository->all();
        return view('parla::tipos_consulta._tabela', compact('tiposConsulta'))->render(); 
    }
}
