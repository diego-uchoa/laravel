<?php

namespace App\Modules\Parla\Http\Controllers;

use App\Modules\Parla\Http\Requests\TipoSituacaoRequest;
use App\Modules\Parla\Repositories\TipoSituacaoRepository;
use App\Http\Controllers\Controller;

class TipoSituacaoController extends Controller
{
    /** @var  TipoSituacaoRepository */
    private $tipoSituacaoRepository;

    public function __construct(TipoSituacaoRepository $tipoSituacaoRepository)
    {
        $this->tipoSituacaoRepository = $tipoSituacaoRepository;
    }

    /**
     * Exibir uma listagem do TipoSituacao.
     *
     */
    public function index()
    {
        $mode = "";
        $tiposSituacao = $this->tipoSituacaoRepository->all();

        return view('parla::tipos_situacao.index', compact('tiposSituacao', 'mode'));
    }

    /**
     * Mostre o formulário para criar um novo TipoSituacao.
     *
     */
    public function create()
    {   
        $mode = "create";

        $html = view('parla::tipos_situacao._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere um TipoSituacao recentemente criado.
     *
     * @param TipoSituacaoRequest $request
     *
     */
    public function store(TipoSituacaoRequest $request)
    {

        $this->tipoSituacaoRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Mostra o formulário para editar um TipoSituacao especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $tipoSituacao = $this->tipoSituacaoRepository->find($id);
        
        $html = view('parla::tipos_situacao._modal', compact('tipoSituacao', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um TipoSituacao especificado.
     *
     * @param  int $id
     * @param TipoSituacaoRequest $request
     *
     * @return Response
     */
    public function update($id, TipoSituacaoRequest $request)
    {
        $tipoSituacao = $this->tipoSituacaoRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove um TipoSituacao específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->tipoSituacaoRepository->find($id)->delete();
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
        $tiposSituacao = $this->tipoSituacaoRepository->all();
        return view('parla::tipos_situacao._tabela', compact('tiposSituacao'))->render(); 
    }
}
