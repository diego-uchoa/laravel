<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\ContratanteRepresentanteRequest;
use App\Modules\Gescon\Http\Requests\ContratanteRepresentanteDevincularRequest;
use App\Modules\Gescon\Repositories\ContratanteRepresentanteRepository;
use App\Modules\Gescon\Repositories\ContratanteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ContratanteRepresentanteController extends Controller
{
    private $contratanteRepresentanteRepository;
    private $contratanteRepository;

    public function __construct(ContratanteRepresentanteRepository $contratanteRepresentanteRepository,
                                    ContratanteRepository $contratanteRepository)
    {
        $this->contratanteRepresentanteRepository = $contratanteRepresentanteRepository;
        $this->contratanteRepository = $contratanteRepository;
    }

    /**
     * Mostre o formulário para criar um novo Representante.
     *
     */
    public function create($id_contratante)
    {   
        $html = view('gescon::contratantes.representante._modal')->with('id_contratante', $id_contratante)->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Associa um Representante recentemente criado ao Contratante
     *
     * @param ContratanteRepresentanteRequest $request
     *
     */
    public function store($id_contratante, ContratanteRepresentanteRequest $request)
    {
        $request->request->add(['id_contratante' => $id_contratante]);
        $this->contratanteRepresentanteRepository->create($request->all());    
        
        $html = $this->renderizarTabela($id_contratante);
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Mostra o formulário para editar um Representante especificado.
     *
     * @param  int $id
     * @param  int $id_contratante
     *
     */
    public function edit($id, $id_contratante)
    {
        $mode = "update";
        $representante = $this->contratanteRepresentanteRepository->find($id);
        
        $html = view('gescon::contratantes.representante._modal', compact('mode', 'representante', 'id_contratante'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um Representante especificado.
     *
     * @param int $id
     * @param int $id_contratante
     * @param ContratanteRepresentanteRequest $request
     *
     * @return Response
     */
    public function update($id, $id_contratante, ContratanteRepresentanteRequest $request)
    {
        $this->contratanteRepresentanteRepository->update($request->all(), $id);
        
        $html = $this->renderizarTabela($id_contratante);

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Mostre o formulário para desvincular um Representante.
     *
     */
    public function modal_destroy_representante($id, $id_contratante)
    {   
        $html = view('gescon::contratantes.representante._modal_desvincular', compact('id', 'id_contratante'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Realiza o desligamento do Representante de um Contratante específico.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function destroy_representante(ContratanteRepresentanteDevincularRequest $request)
    {
        try{
        
            $contratanteRepresentante = $this->contratanteRepresentanteRepository->find($request['id']);
            if ($contratanteRepresentante){
                
                $dt_inicio = explode('/', $contratanteRepresentante['dt_inicio']);
                $dt_inicio_Carbon = Carbon::createFromDate($dt_inicio[2], $dt_inicio[1], $dt_inicio[0]);

                $dt_fim = explode('/', $request['dt_fim']);
                $dt_fim_Carbon = Carbon::createFromDate($dt_fim[2], $dt_fim[1], $dt_fim[0]);
                
                $diferenca_datas = $dt_inicio_Carbon->copy()->diffInDays($dt_fim_Carbon, false);

                if ($diferenca_datas < 0){

                    throw new \Exception(" A data de desligamento não pode ser menor que a data de início.", 1);

                }else{

                    $this->contratanteRepresentanteRepository->find($request['id'])->update(['dt_fim' => $request['dt_fim']]);
                    $html = $this->renderizarTabela($request['id_contratante']);
                    
                    return response(['msg' => 'Representante foi desvinculado com sucesso.', 'status' => 'success', 'html'=> $html]);

                }
            }

        }catch(\Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }  

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela($id_contratante)
    {
        $contratante = $this->contratanteRepository->find($id_contratante);
        return view('gescon::contratantes.representante._tabela_representantes', compact('contratante'))->render(); 
    }
}
