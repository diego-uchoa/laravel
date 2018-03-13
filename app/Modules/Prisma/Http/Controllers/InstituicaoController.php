<?php

namespace App\Modules\Prisma\Http\Controllers;

use App\Modules\Prisma\Http\Requests\InstituicaoRequest;
use App\Modules\Prisma\Repositories\InstituicaoRepository;
use App\Modules\Prisma\Repositories\InstituicaoResponsavelPrevisaoRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\UtilHelper;

class InstituicaoController extends Controller
{
    /** @var  InstituicaoRepository */
    private $instituicaoRepository;
    protected $instituicaoResponsavelPrevisaoRepository;

    public function __construct(InstituicaoRepository $instituicaoRepository, InstituicaoResponsavelPrevisaoRepository $instituicaoResponsavelPrevisaoRepository)
    {
        $this->instituicaoRepository = $instituicaoRepository;
        $this->instituicaoResponsavelPrevisaoRepository = $instituicaoResponsavelPrevisaoRepository;
    }

    /**
     * Exibir uma listagem do Instituicao.
     *
     */
    public function index()
    {
        $instituicoes = $this->instituicaoRepository->all();
        
        return view('prisma::instituicoes.index', compact('instituicoes'));
    }

    /**
     * Mostre o formulário para criar um novo Instituicao.
     *
     */
    public function create()
    {   
        
        return view('prisma::instituicoes.create');

    }

    /**
     * Insere um Instituicao recentemente criado.
     *
     * @param InstituicaoRequest $request
     *
     */
    public function store(InstituicaoRequest $request)
    {

        $this->instituicaoRepository->create($request->all());

        return redirect()->route('prisma::instituicoes.index')->with('message', trans('alerts.registro.created'));

    }

    /**
     * Mostra o formulário para editar um Instituicao especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $instituicao = $this->instituicaoRepository->find($id);

        return view('prisma::instituicoes.edit', compact('instituicao'));
    }

    public function editNomeRelatorio($id)
    {
        $instituicao = $this->instituicaoRepository->find($id);

        $html = view('prisma::instituicoes.edit.nome_relatorio._modal', compact('instituicao'))->render();

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]); 
    }

    public function editInstituicaoResponsavelPrevisao($id) {
        $instituicao = $this->instituicaoRepository->find($id);

        $instituicaoResponsavelPrevisao = $this->instituicaoResponsavelPrevisaoRepository->listaTodosSemVinculo();
        if($instituicao->instituicaoPrevisao) {
            $instituicaoResponsavelPrevisao += [$instituicao->instituicaoPrevisao->id_instituicao_responsavel_previsao => $instituicao->instituicaoPrevisao->no_instituicao_responsavel_previsao];
        }

        $html = view('prisma::instituicoes.edit.instituicao_responsavel_previsao._modal', compact('instituicao','instituicaoResponsavelPrevisao'))->render();

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]); 
    }


    /**
     * Mostra o formulário para editar um Instituicao do usuário logado.
     *
     * @param  int $id
     *
     */
    // public function show()
    // {
    //     $usuario = UtilHelper::getUsuario();
       
    //     $instituicao = $usuario->instituicaoPrisma;

    //     return view('prisma::instituicoes.show', compact('instituicao'));
    // }

    public function show($id = null) {
        $usuarioLogado = UtilHelper::getUsuario();

        if($usuarioLogado->hasPerfil('PRISMA-Gestor')) {
            $instituicao = $this->instituicaoRepository->find($id);    
        }
        else {
            $instituicao = $usuarioLogado->instituicaoPrisma;
        }

        return view('prisma::instituicoes.show', compact('instituicao'));
    }


    /**
     * Atualiza um Instituicao especificado.
     *
     * @param int $id
     * @param InstituicaoRequest $request
     *
     * @return Response
     */
    public function update($id, InstituicaoRequest $request)
    {
        try{
            
            $this->instituicaoRepository->find($id)->update($request->all());

            return redirect()->route('prisma::instituicoes.index')->with('message', trans('alerts.registro.updated'));    

        }catch(\Exception $e){
            
            $messagesExceptions = [
               'exception' => 'Erro '. $e->getCode() .' : ', 
               'message_exception' => $e->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions, $e->getCode());

        }
    }

    public function updateNomeRelatorio($id, InstituicaoRequest $request)
    {
        try{
            
            $this->instituicaoRepository->find($id)->update($request->all()); 

            $instituicao = $this->instituicaoRepository->find($id);
            $html = view('prisma::instituicoes.show._dados_instituicao', compact('instituicao'))->render(); 

            return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);   

        }catch(\Exception $e){
            
            $messagesExceptions = [
               'exception' => 'Erro '. $e->getCode() .' : ', 
               'message_exception' => $e->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions, $e->getCode());

        }
    }

    public function updateInstituicaoResponsavelPrevisao($id, Request $request)
    {
        try{
            
            $this->instituicaoRepository->find($id)->update($request->all()); 

            $instituicao = $this->instituicaoRepository->find($id);
            $html = view('prisma::instituicoes.show._dados_instituicao_responsavel_previsao', compact('instituicao'))->render(); 

            return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);   

        }catch(\Exception $e){
            
            $messagesExceptions = [
               'exception' => 'Erro '. $e->getCode() .' : ', 
               'message_exception' => $e->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions, $e->getCode());

        }
    }


    /**
     * Remove um Instituicao específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->instituicaoRepository->find($id)->delete();
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }

    public function destroyInstituicaoResponsavelPrevisao($id) {
        try{
            $this->instituicaoRepository->find($id)->update(['id_instituicao_responsavel_previsao' => null]); 

            $instituicao = $this->instituicaoRepository->find($id);
            $html = view('prisma::instituicoes.show._dados_instituicao_responsavel_previsao', compact('instituicao'))->render(); 

            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);   

        }catch(Exception $e) {
            \Log::info($e);
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
        $instituicoes = $this->instituicaoRepository->all();
        return view('prisma::instituicoes._tabela', compact('instituicoes'))->render(); 
    }


    /**
     * Método responsável por listar todos as Insituicoes que atendam o parametro informado para preencher uma Combo (Select)
     * 
     * @return Json
     */
    public function list(Request $request)
    {
        $instituicoes = $this->instituicaoRepository->prepareListaSelect2ByNome($request["parametro"]);
        return $instituicoes;
    }
}
