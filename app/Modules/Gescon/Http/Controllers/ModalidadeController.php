<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\ModalidadeRequest;
use App\Modules\Gescon\Repositories\ModalidadeRepository;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class ModalidadeController extends Controller
{
    /** @var  ModalidadeRepository */
    private $modalidadeRepository;

    public function __construct(ModalidadeRepository $modalidadeRepository)
    {
        $this->modalidadeRepository = $modalidadeRepository;
    }

    /**
     * Exibir uma listagem do Modalidade.
     *
     */
    public function index()
    {
        $mode = "";
        
        return view('gescon::modalidades.index', compact('mode'));
    }

    /**
     * Recuperar os registros de Modalidades cadastrados
     *
     */
    public function records(Request $request)
    {   
        $modalidades = $this->modalidadeRepository->all();
        return Datatables::of($modalidades)
                
                ->addColumn('no_modalidade', function ($modalidade) {
                                return $modalidade->no_modalidade;
                            })
                ->make(true);
    }    

    /**
     * Mostre o formulário para criar um novo Modalidade.
     *
     */
    public function create()
    {   
        $mode = "create";

        $html = view('gescon::modalidades._modal', compact('mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere um Modalidade recentemente criado.
     *
     * @param ModalidadeRequest $request
     *
     */
    public function store(ModalidadeRequest $request)
    {

        $this->modalidadeRepository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

    }

    /**
     * Mostra o formulário para editar um Modalidade especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $modalidade = $this->modalidadeRepository->find($id);
        
        $html = view('gescon::modalidades._modal', compact('modalidade', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza um Modalidade especificado.
     *
     * @param  int $id
     * @param ModalidadeRequest $request
     *
     * @return Response
     */
    public function update($id, ModalidadeRequest $request)
    {
        $modalidade = $this->modalidadeRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Remove um Modalidade específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->modalidadeRepository->find($id)->delete();
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

    /**
     * Método responsável por listar todos os Tipos de Modalidades para preencher uma Combo (Select)
     * 
     * @return Json
     */
    public function listModalidades()
    {
        $listaModalidades = $this->modalidadeRepository->prepareListaSelect();
        return $listaModalidades;
    }  


    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        $modalidades = $this->modalidadeRepository->all();
        return view('gescon::modalidades._tabela', compact('modalidades'))->render(); 
    }
}
