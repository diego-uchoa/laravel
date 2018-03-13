<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\ContratanteRequest;
use App\Modules\Gescon\Repositories\ContratanteRepository;
use App\Modules\Gescon\Repositories\ContratanteRepresentanteRepository;
use App\Modules\Gescon\Repositories\ContratanteUsuarioRepository;
use App\Modules\Gescon\Services\ContratoSiasgWsService;
use App\Exceptions;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use DB;

class ContratanteController extends Controller
{
    /** @var  ContratanteRepository */
    private $contratanteRepository;
    private $contratanteRepresentanteRepository;
    private $contratanteUsuarioRepository;
    private $service;

    public function __construct(ContratanteRepository $contratanteRepository,
                                    ContratanteRepresentanteRepository $contratanteRepresentanteRepository,
                                    ContratanteUsuarioRepository $contratanteUsuarioRepository,
                                    ContratoSiasgWsService $service)
    {
        $this->contratanteRepository = $contratanteRepository;
        $this->contratanteRepresentanteRepository = $contratanteRepresentanteRepository;
        $this->contratanteUsuarioRepository = $contratanteUsuarioRepository;
        $this->service = $service;
    }

    /**
     * Exibir uma listagem do Contratante.
     *
     */
    public function index()
    {
        $contratante = $this->contratanteRepository->all();

        return view('gescon::contratantes.index', compact('contratante'));
    }

    /**
     * Recuperar os registros de Contratantes cadastrados
     *
     */
    public function records(Request $request)
    {   
        $contratantes = $this->contratanteRepository->all();
        return Datatables::of($contratantes)
                
                ->addColumn('sg_uasg', function ($contratante) {
                                return $contratante->orgao->sg_orgao;
                            })
                ->addColumn('no_representante', function ($contratante) {
                                if($contratante->representante)
                                    return $contratante->representante->no_representante;
                                else
                                    return "-";
                            })
                ->addColumn('operacoes', function ($contratante) {
                                return '<a href="'.route('gescon::contratantes.representante.associate_representante',['id'=>$contratante->id_contratante]).'" class="btn btn-xs btn-info" data-rel="tooltip" data-original-title="Gerenciar Representante">
                                            <i class="ace-icon fa fa-user-plus"></i>
                                        </a>
                                        <a href="'.route('gescon::contratantes.usuario.associate_usuario',['id'=>$contratante->id_contratante]).'" class="btn btn-xs btn-warning" data-rel="tooltip" data-original-title="Adicionar Usuário">
                                            <i class="ace-icon fa fa-user-plus"></i>
                                        </a>
                                        <a href="'.route('gescon::contratantes.assinante.associate_assinante',['id'=>$contratante->id_contratante]).'" class="btn btn-xs btn-grey" data-rel="tooltip" data-original-title="Adicionar Assinante">
                                            <i class="ace-icon fa fa-user-plus"></i>
                                        </a>
                                        <a href="#" data-id="'.$contratante->id_contratante.'" class="btn btn-xs btn-danger delete" data-url="'.route('gescon::contratantes.destroy',['id'=>$contratante->id_contratante]).'" data-rel="tooltip" data-original-title="Excluir">
                                            <i class="ace-icon fa fa-trash-o"></i>
                                        </a>';
                            })
                ->rawColumns(['operacoes'])
                ->make(true);
    }

    /**
     * Mostre o formulário para criar um novo Contratante.
     *
     */
    public function create()
    {   
        
        return view('gescon::contratantes.create');

    }

    /**
     * Insere um Contratante recentemente criado.
     *
     * @param ContratanteRequest $request
     *
     */
    public function store(ContratanteRequest $request)
    {
        try{
            
            DB::beginTransaction(); 
                $contratante = $this->contratanteRepository->create($request->except(['nr_cpf_representante','no_representante','nr_rg_representante','ds_funcao_representante']));
                $request->request->add(['id_contratante' => $contratante->id_contratante]);
                $this->contratanteRepresentanteRepository->create($request->only(['nr_cpf_representante','no_representante','nr_rg_representante','ds_funcao_representante','dt_inicio','id_contratante']));
            DB::commit();    
            return redirect()->route('gescon::contratantes.index')->with('message', trans('alerts.registro.created'));

        }catch (\Exception $e){

            DB::rollBack();
            $messagesExceptions = [
               'exception' => 'Não foi possível cadastrar o Contratante. Erro '. $e->getCode() .' : ', 
               'message_exception' => $e->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions, $e->getCode());
        }

    }

    /**
     * Mostra o formulário para Associar/Alterar um Representante do Contratante
     *
     * @param  int $id
     *
     */
    public function associate_representante($id)
    {
        $contratante = $this->contratanteRepository->find($id);

        return view('gescon::contratantes.representante.associate_representante', compact('contratante'));
    }

    /**
     * Mostra o formulário para Associar/Alterar um Usuário do Contratante
     *
     * @param  int $id
     *
     */
    public function associate_usuario($id)
    {
        $contratante = $this->contratanteRepository->find($id);
        return view('gescon::contratantes.usuario.associate_usuario', compact('contratante'));
    }

    /**
     * Mostra o formulário para Associar/Alterar um Assinante do Contratante
     *
     * @param  int $id
     *
     */
    public function associate_assinante($id)
    {
        $mode = "create";
        $contratante = $this->contratanteRepository->find($id);
        return view('gescon::contratantes.assinante.associate_assinante', compact('contratante', 'mode'));
    }

    /**
     * Atualiza um Contratante especificado.
     *
     * @param int $id
     * @param ContratanteRequest $request
     *
     * @return Response
     */
    public function update($id, ContratanteRequest $request)
    {
        try{
            
            $this->contratanteRepository->find($id)->update($request->all());

            return redirect()->route('gescon::contratantes.index')->with('message', trans('alerts.registro.updated'));    

        }catch(\Exception $e){
            
            $messagesExceptions = [
               'exception' => 'Erro '. $e->getCode() .' : ', 
               'message_exception' => $e->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions, $e->getCode());

        }
    }

    /**
     * Remove um Contratante específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->contratanteRepository->find($id)->delete();
            $this->contratanteUsuarioRepository->deleteBy([['id_contratante','=',$id]]);
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }

    /**
     * Verifica se existe uma associação ativa a um Contratante
     *
     * @param  int $id_contratante
     *
     * @return boolean
     */
    public function association_exist($id)
    {
        $retorno = ['status' => false];
        $contratante = $this->contratanteRepository->find($id);
        
        if ($contratante->representante){
            $retorno = ['status' => true, 'representante' => $contratante->representante->no_representante];
        }

        return response()->json($retorno);
    }

    /**
     * Retorna o Contratante cadastrado no BD de acordo com o Código UASG (co_siafi)
     *
     * @param  int $co_uasg
     *
     * @return Array
     */
    public function findDadosContratanteByUasg($co_uasg)
    {
        $retorno = [];
        $contratante = $this->contratanteRepository->findByUasg($co_uasg);
        
        if (!$contratante){
            throw new Exception('UASG não encontrada.');
        }

        return response()->json($contratante);
    }

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        $contratante = $this->contratanteRepository->all();
        return view('gescon::contratantes._tabela', compact('contratante'))->render(); 
    }
    
}
