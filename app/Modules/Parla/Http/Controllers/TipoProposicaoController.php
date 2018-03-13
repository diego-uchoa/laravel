<?php

namespace App\Modules\Parla\Http\Controllers;

use App\Modules\Parla\Http\Requests\TipoProposicaoRequest;
use App\Modules\Parla\Repositories\TipoProposicaoRepository;
use App\Http\Controllers\Controller;

class TipoProposicaoController extends Controller
{
    /** @var  TipoProposicaoRepository */
    private $tipoProposicaoRepository;

    public function __construct(TipoProposicaoRepository $tipoProposicaoRepository)
    {
        $this->tipoProposicaoRepository = $tipoProposicaoRepository;
    }

    /**
     * Display a listing of the TipoProposicao.
     *
     * @param Request $request
     */
    public function index()
    {
        $mode = "";
        $tiposProposicao = $this->tipoProposicaoRepository->all();

        return view('parla::tipos_proposicao.index', compact('tiposProposicao', 'mode'));
    }

    /**
     * Show the form for creating a new TipoProposicao.
     *
     */
    public function create()
    {   
        $mode = "create";

        $html = view('parla::tipos_proposicao._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Store a newly created TipoProposicao in storage.
     *
     * @param CreateTipoProposicaoRequest $request
     *
     */
    public function store(TipoProposicaoRequest $request)
    {
        $this->tipoProposicaoRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Show the form for editing the specified TipoProposicao.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $tipoProposicao = $this->tipoProposicaoRepository->find($id);
        
        $html = view('parla::tipos_proposicao._modal', compact('tipoProposicao', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Update the specified TipoProposicao in storage.
     *
     * @param  int              $id
     * @param UpdateTipoProposicaoRequest $request
     *
     * @return Response
     */
    public function update($id, TipoProposicaoRequest $request)
    {
        $tipoProposicao = $this->tipoProposicaoRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove the specified TipoProposicao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->tipoProposicaoRepository->find($id)->delete();
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
        $tiposProposicao = $this->tipoProposicaoRepository->all();
        return view('parla::tipos_proposicao._tabela', compact('tiposProposicao'))->render(); 
    }
}
