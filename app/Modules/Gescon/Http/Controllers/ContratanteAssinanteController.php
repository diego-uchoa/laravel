<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\ContratanteAssinanteRequest;
use App\Modules\Gescon\Repositories\ContratanteAssinanteRepository;
use App\Modules\Gescon\Repositories\ContratanteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContratanteAssinanteController extends Controller
{
    private $contratanteAssinanteRepository;
    private $contratanteRepository;

    public function __construct(ContratanteAssinanteRepository $contratanteAssinanteRepository,
                                    ContratanteRepository $contratanteRepository)
    {
        $this->contratanteAssinanteRepository = $contratanteAssinanteRepository;
        $this->contratanteRepository = $contratanteRepository;
    }

    /**
     * Mostre o formulário para criar um novo Assinante.
     *
     */
    public function create($id_contratante)
    {   
        $mode = "create";   
        $html = view('gescon::contratantes.assinante._modal', compact('id_contratante', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Associa um Assinante recentemente criado ao Contratante
     *
     * @param ContratanteAssinanteRequest $request
     *
     */
    public function store($id_contratante, ContratanteAssinanteRequest $request)
    {
        $request->request->add(['id_contratante' => $id_contratante]);

        $existe = $this->contratanteAssinanteRepository->findAssinanteByContratante($request['nr_cpf_assinante'], $request['id_contratante']);

        if (!$existe){
            $this->contratanteAssinanteRepository->create($request->all());    
            $html = $this->renderizarTabela($id_contratante);
            return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    
        }else{
            return response(['msg' => 'O assinante informado já está cadastrado, favor verificar.', 'detail' => ' Assinante já cadastrado para a UASG informada.', 'status' => 'error']);
        }
    }

    /**
     * Mostra o formulário para editar um Assinante especificado.
     *
     * @param  int $id
     * @param  int $id_contratante
     *
     */
    public function edit($id, $id_contratante)
    {
        $mode = "update";
        $assinante = $this->contratanteAssinanteRepository->find($id);
        
        $html = view('gescon::contratantes.assinante._modal', compact('mode', 'assinante', 'id_contratante'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um Assinante especificado.
     *
     * @param int $id
     * @param int $id_contratante
     * @param ContratanteAssinanteRequest $request
     *
     * @return Response
     */
    public function update($id, $id_contratante, ContratanteAssinanteRequest $request)
    {
        $this->contratanteAssinanteRepository->update($request->all(), $id);
        
        $html = $this->renderizarTabela($id_contratante);

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Realiza o desligamento do Assinante de um Contratante específico.
     *
     * @param  int $id
     * @param  int $id_contratante
     *
     * @return Response
     */
    public function destroy_assinante($id, $id_contratante)
    {
        try{
            
            $this->contratanteAssinanteRepository->delete($id);
            $html = $this->renderizarTabela($id_contratante);
            
            return response(['msg' => 'Assinante foi desvinculado com sucesso.', 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }  

    /**
     * Realiza o cadastro do Assinante via ajax através da funcionalidade de Cadastro de Contratos
     *
     * @param ContratanteAssinanteRequest $request
     *
     */
    public function store_assinante_contrato(ContratanteAssinanteRequest $request)
    {
        $request->request->add(['id_contratante' => $request['id_contratante_contrato']]);
        $existe = $this->contratanteAssinanteRepository->findAssinanteByContratante($request['nr_cpf_assinante'], $request['id_contratante']);

        if (!$existe){
            $retorno = $this->contratanteAssinanteRepository->create($request->all());    
            $html = $retorno;    
            return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    
        }else{
            return response(['msg' => 'O assinante informado já está cadastrado, favor verificar.', 'detail' => ' Assinante já cadastrado para a UASG informada.', 'status' => 'error']);
        }
    }

    /**
     * Realiza a busca do Assinante no BD pelo seu ID
     *
     * @param Integer $id_contratante_assinante
     *
     */
    public function findAssinanteById($id_contratante_assinante)
    {
        $retorno = array();
        $assinante = $this->contratanteAssinanteRepository->find($id_contratante_assinante);

        if (!empty($assinante)){
            
            $retorno['no_assinante'] = $assinante->no_assinante;
            $retorno['ds_funcao_assinante'] = $assinante->ds_funcao_assinante;

        }
        
        return json_encode($retorno);
    }

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela($id_contratante)
    {
        $contratante = $this->contratanteRepository->find($id_contratante);
        return view('gescon::contratantes.assinante._tabela_assinantes', compact('contratante'))->render(); 
    }
}
