<?php

namespace App\Modules\Prisma\Http\Controllers;

use App\Modules\Prisma\Http\Requests\InstituicaoResponsavelPrevisaoRequest;
use App\Modules\Prisma\Repositories\InstituicaoResponsavelPrevisaoRepository;
use App\Http\Controllers\Controller;

class InstituicaoResponsavelPrevisaoController extends Controller
{
    /** @var  InstituicaoResponsavelPrevisaoRepository */
    private $instituicaoResponsavelPrevisaoRepository;

    public function __construct(InstituicaoResponsavelPrevisaoRepository $instituicaoResponsavelPrevisaoRepository)
    {
        $this->instituicaoResponsavelPrevisaoRepository = $instituicaoResponsavelPrevisaoRepository;
    }

    /**
     * Exibir uma listagem do InstituicaoResponsavelPrevisao.
     *
     */
    public function index()
    {
        $mode = "";
        $instituicoesResponsavelPrevisao = $this->instituicaoResponsavelPrevisaoRepository->all();

        return view('prisma::instituicoes_responsavel_previsao.index', compact('instituicoesResponsavelPrevisao', 'mode'));
    }

    /**
     * Mostre o formulário para criar um novo InstituicaoResponsavelPrevisao.
     *
     */
    public function create()
    {   
        $mode = "create";

        $html = view('prisma::instituicoes_responsavel_previsao._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere um InstituicaoResponsavelPrevisao recentemente criado.
     *
     * @param InstituicaoResponsavelPrevisaoRequest $request
     *
     */
    public function store(InstituicaoResponsavelPrevisaoRequest $request)
    {

        $this->instituicaoResponsavelPrevisaoRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Mostra o formulário para editar um InstituicaoResponsavelPrevisao especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $instituicaoResponsavelPrevisao = $this->instituicaoResponsavelPrevisaoRepository->find($id);
        
        $html = view('prisma::instituicoes_responsavel_previsao._modal', compact('instituicaoResponsavelPrevisao', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um InstituicaoResponsavelPrevisao especificado.
     *
     * @param  int $id
     * @param InstituicaoResponsavelPrevisaoRequest $request
     *
     * @return Response
     */
    public function update($id, InstituicaoResponsavelPrevisaoRequest $request)
    {
        $instituicaoResponsavelPrevisao = $this->instituicaoResponsavelPrevisaoRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove um InstituicaoResponsavelPrevisao específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->instituicaoResponsavelPrevisaoRepository->find($id)->delete();
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
        $instituicoesResponsavelPrevisao = $this->instituicaoResponsavelPrevisaoRepository->all();
        return view('prisma::instituicoes_responsavel_previsao._tabela', compact('instituicoesResponsavelPrevisao'))->render(); 
    }

    /**
     * Método responsável por retornar todas as Instituições Responsáveis por Previsão que não estejam associadas as Instituições cadastradas
     * 
     * @return Array $resultado
     */    
    public function listaTodosSemVinculo()
    {    
        $this->instituicaoResponsavelPrevisaoRepository->listaTodosSemVinculo();
    }
}
