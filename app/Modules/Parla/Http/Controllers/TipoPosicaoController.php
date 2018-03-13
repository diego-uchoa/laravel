<?php

namespace App\Modules\Parla\Http\Controllers;

use App\Modules\Parla\Http\Requests\TipoPosicaoRequest;
use App\Modules\Parla\Repositories\TipoPosicaoRepository;
use App\Http\Controllers\Controller;

class TipoPosicaoController extends Controller
{
    /** @var  TipoPosicaoRepository */
    private $tipoPosicaoRepository;

    public function __construct(TipoPosicaoRepository $tipoPosicaoRepository)
    {
        $this->tipoPosicaoRepository = $tipoPosicaoRepository;
    }

    /**
     * Display a listing of the TipoPosicao.
     *
     * @param Request $request
     */
    public function index()
    {
        $mode = "";
        $tiposPosicao = $this->tipoPosicaoRepository->all();

        return view('parla::tipos_posicao.index', compact('tiposPosicao', 'mode'));
    }

    /**
     * Show the form for creating a new TipoPosicao.
     *
     */
    public function create()
    {   
        $mode = "create";

        $html = view('parla::tipos_posicao._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Store a newly created TipoPosicao in storage.
     *
     * @param CreateTipoPosicaoRequest $request
     *
     */
    public function store(TipoPosicaoRequest $request)
    {

        $this->tipoPosicaoRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Show the form for editing the specified TipoPosicao.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $tipoPosicao = $this->tipoPosicaoRepository->find($id);
        
        $html = view('parla::tipos_posicao._modal', compact('tipoPosicao', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Update the specified TipoPosicao in storage.
     *
     * @param  int              $id
     * @param UpdateTipoPosicaoRequest $request
     *
     * @return Response
     */
    public function update($id, TipoPosicaoRequest $request)
    {
        $tipoPosicao = $this->tipoPosicaoRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove the specified TipoPosicao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->tipoPosicaoRepository->find($id)->delete();
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
        $tiposPosicao = $this->tipoPosicaoRepository->all();
        return view('parla::tipos_posicao._tabela', compact('tiposPosicao'))->render(); 
    }
}
