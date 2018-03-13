<?php

namespace App\Modules\Prisma\Http\Controllers;

use App\Modules\Prisma\Repositories\InstituicaoRepository;
use App\Modules\Prisma\Services\ControleUsuarioService;

use App\Modules\Sisadm\Repositories\UserRepository;
use App\Modules\Sisadm\Repositories\PerfilRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;
use App\Modules\Sisadm\Services\UserService;
use App\Modules\Sisadm\Http\Requests\UsuarioRequest;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Collection;
use Auth;
use App\Helpers\UtilHelper;


use App\Modules\Sisadm\Repositories\OrgaoRepository;

class ControleUsuarioController extends Controller
{

    protected $repository;
    protected $instituicaoRepository;
    protected $perfilRepository;
    protected $sistemaRepository;
    protected $controleUsuarioService;

    protected $userService;
    protected $orgaoRepository;
    
    public function __construct(ControleUsuarioService $controleUsuarioService,
        UserService $userService, UserRepository $repository, 
                                    InstituicaoRepository $instituicaoRepository, PerfilRepository $perfilRepository, SistemaRepository $sistemaRepository,
                                    OrgaoRepository $orgaoRepository)
    {
        $this->controleUsuarioService = $controleUsuarioService;
        $this->instituicaoRepository = $instituicaoRepository;
        $this->repository = $repository;
        $this->perfilRepository = $perfilRepository;
        $this->sistemaRepository = $sistemaRepository;

        $this->userService = $userService;
        $this->orgaoRepository = $orgaoRepository;
     }

    public function index()
    {
        $usuarios = $this->repository->findExternoOrderByName();
        $mode = "criar";
        $instituicoes = $this->instituicaoRepository->prepareListaSelect2();
        return view('prisma::usuarios.index', compact('mode', 'instituicoes'));
    }

    public function editores()
    {
        $usuario = UtilHelper::getUsuario();
       
        $instituicao = $usuario->instituicaoPrisma;

        $usuarios = $instituicao->usuarios;

        $mode = "criar";
        $instituicoes = $this->instituicaoRepository->prepareListaSelect2();

        return view('prisma::usuarios.editores', compact('mode', 'instituicoes', 'usuarios'));
    }

    public function records(Request $request)
    {
        $usuario = UtilHelper::getUsuario();

        if($usuario->hasPerfil('PRISMA-Gestor')){

            $usuarios = $this->repository->findExternoOrderByName();
            return Datatables::of($usuarios)

            ->addColumn('no_usuario', function ($usuario) {
                return $usuario->no_usuario;
            })
            ->addColumn('email', function ($usuario) {
                return $usuario->email;
            })

            ->addColumn('instituicao', function ($usuario) {
                if($usuario->instituicaoPrisma){
                    return $usuario->instituicaoPrisma->no_razao_social;
                }

            })

            ->addColumn('telefone', function ($usuario) {
                if($usuario->instituicaoPrisma){
                    return $usuario->instituicaoPrisma->pivot->nr_telefone;
                }

            })

            ->addColumn('operacoes', function ($usuario) {
                return "<a href=".url('prisma/usuarios/perfis/'.$usuario->id_usuario.'')." class='btn btn-xs btn-default'>
                Perfis
            </a>
            <a href='#' data-url=".url('prisma/usuarios/edit/'.$usuario->id_usuario.'')." class='btn btn-xs btn-info update'>
                <i class='ace-icon fa fa-pencil'></i>
            </a>
            <a href='#' data-id='{{ $usuario->id_usuario }}' data-url=".url('prisma/usuarios/destroy/'.$usuario->id_usuario.'')." class='btn btn-xs btn-danger delete'>
                <i class='ace-icon fa fa-trash-o'></i>
            </a>   ";
            })
            ->rawColumns(['operacoes'])
            ->make(true);

        }

        else {
       
            $instituicao = $usuario->instituicaoPrisma;

            $usuarios = $instituicao->usuarios;

            return Datatables::of($usuarios)

            ->addColumn('no_usuario', function ($usuario) {
                return $usuario->no_usuario;
            })
            ->addColumn('email', function ($usuario) {
                return $usuario->email;
            })

            ->addColumn('instituicao', function ($usuario) {
                if($usuario->instituicaoPrisma){
                    return $usuario->instituicaoPrisma->no_razao_social;
                }

            })

            ->addColumn('telefone', function ($usuario) {
                if($usuario->instituicaoPrisma){
                    return $usuario->instituicaoPrisma->pivot->nr_telefone;
                }

            })

            ->addColumn('operacoes', function ($usuario) {
                return "
            <a href='#' data-url=".url('prisma/usuarios/edit/'.$usuario->id_usuario.'')." class='btn btn-xs btn-info update'>
                <i class='ace-icon fa fa-pencil'></i>
            </a>
            <a href='#' data-id='{{ $usuario->id_usuario }}' data-url=".url('prisma/usuarios/destroy/'.$usuario->id_usuario.'')." class='btn btn-xs btn-danger delete'>
                <i class='ace-icon fa fa-trash-o'></i>
            </a>   ";
            })
            ->rawColumns(['operacoes'])
            ->make(true);

        }

        
    }

    public function create()
    {
        $mode = "create";
        $instituicoes = $this->instituicaoRepository->prepareListaSelect2();
        $html = view('prisma::usuarios._modal', compact('instituicoes', 'mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
        //return view('sisadm::usuarios.create', compact('listaOrgaos'));
    }

    public function createEditor($id_instituicao) {
        $mode = "create";
        $html = view('prisma::usuarios.editores._modal', compact('mode','id_instituicao'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function createResponsavel($id_instituicao) {
        $mode = "create";
        $html = view('prisma::usuarios.responsavel._modal', compact('mode','id_instituicao'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function store(Request $request) {   

        $usuario = $this->controleUsuarioService->store($request);
        if($usuario->getOriginalContent()['status'] == 'success'){

            $usuarioLogado = UtilHelper::getUsuario();

            if($usuarioLogado->hasPerfil('PRISMA-Gestor')){
                $instituicao = $this->instituicaoRepository->find($request['id_instituicao']);    
            }else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }
            
            $perfilEditor = $this->controleUsuarioService->associarPerfil($request->nr_cpf,'PRISMA-EditorInstituicao');
            $usuarioAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$request);

        }    

        return $usuario;     
        
    }

    public function storeEditor(Request $request) { 
        $usuario = $this->controleUsuarioService->store($request);

        $request['in_perfil'] = 'E';
        $request['no_cargo'] = null;

        if($usuario->getOriginalContent()['status'] == 'success'){

            $usuarioLogado = UtilHelper::getUsuario();

            if($usuarioLogado->hasPerfil('PRISMA-Gestor')){
                $instituicao = $this->instituicaoRepository->find($request['id_instituicao']);    
            }else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }
            
            $perfilEditor = $this->controleUsuarioService->associarPerfil($request->nr_cpf,'PRISMA-EditorInstituicao');
            $usuarioAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$request);

            $html = view('prisma::instituicoes.show._dados_editores', compact('instituicao'))->render(); 

            return response(['msg' => $usuario->getOriginalContent()['msg'], 'status' => 'success', 'html'=> $html]); 

        }    

        return $usuario;     
        
    }

    public function storeResponsavel(Request $request) { 
        $usuario = $this->controleUsuarioService->store($request);

        $request['in_perfil'] = 'R';

        if($usuario->getOriginalContent()['status'] == 'success'){

            $usuarioLogado = UtilHelper::getUsuario();

            if($usuarioLogado->hasPerfil('PRISMA-Gestor')){
                $instituicao = $this->instituicaoRepository->find($request['id_instituicao']);    
            }else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }
            
            $perfilResponsavel = $this->controleUsuarioService->associarPerfil($request->nr_cpf,'PRISMA-ResponsavelInstituicao');
            $usuarioAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$request);

            $html = view('prisma::instituicoes.show._dados_responsavel', compact('instituicao'))->render(); 

            return response(['msg' => $usuario->getOriginalContent()['msg'], 'status' => 'success', 'html'=> $html]); 

        }    

        return $usuario;     
        
    }

    public function edit($id) {
        $mode = "update";
        $usuario = $this->repository->find($id);

        if($usuario->instituicaoPrisma) {
            $usuario->nr_telefone = $usuario->instituicaoPrisma->pivot->nr_telefone;    
        }
        
        $instituicoes = $this->instituicaoRepository->prepareListaSelect2();
        
        $html = view('prisma::usuarios._modal', compact('usuario', 'instituicoes', 'mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);

    }

    public function update(Request $request, $id)
    {
        $usuario = $this->controleUsuarioService->update($request, $id);

        if($usuario->getOriginalContent()['status'] == 'success'){

            $usuarioLogado = UtilHelper::getUsuario();

            if($usuarioLogado->hasPerfil('PRISMA-Gestor')){
                $instituicao = $this->instituicaoRepository->find($request['id_instituicao']);    
            }else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }

            $usuarioAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$request);
        }

        return $usuario;
    }

    public function editEditor($id)
    {
        $mode = "update";
        $usuario = $this->repository->find($id);

        if($usuario->instituicaoPrisma) {
            $usuario->nr_telefone = $usuario->instituicaoPrisma->pivot->nr_telefone;  
            $id_instituicao = $usuario->instituicaoPrisma;  
        }
        
        $html = view('prisma::usuarios.editores._modal', compact('usuario','mode','id_instituicao'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);

    }

    public function updateEditor(Request $request, $id)
    {
        $usuario = $this->repository->find($id);
        $request['id_instituicao'] = $usuario->instituicaoPrisma->id_instituicao;
        $usuario = $this->controleUsuarioService->update($request, $id);

        if($usuario->getOriginalContent()['status'] == 'success'){

            $usuarioLogado = UtilHelper::getUsuario();

            if($usuarioLogado->hasPerfil('PRISMA-Gestor')){
                $instituicao = $this->instituicaoRepository->find($request['id_instituicao']);    
            }else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }

            $usuarioAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$request);

            $html = view('prisma::instituicoes.show._dados_editores', compact('instituicao'))->render(); 

            return response(['msg' => $usuario->getOriginalContent()['msg'], 'status' => 'success', 'html'=> $html]); 

        }

        return $usuario;
    }

    public function editResponsavel($id)
    {
        $mode = "update";
        $usuario = $this->repository->find($id);

        if($usuario->instituicaoPrisma) {
            $usuario->nr_telefone = $usuario->instituicaoPrisma->pivot->nr_telefone;    
            $usuario->no_cargo = $usuario->instituicaoPrisma->pivot->no_cargo;    
        }
        
        $html = view('prisma::usuarios.responsavel._modal', compact('usuario','mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);

    }

    public function updateResponsavel(Request $request, $id)
    {
        $usuario = $this->repository->find($id);
        $request['id_instituicao'] = $usuario->instituicaoPrisma->id_instituicao;
        $usuario = $this->controleUsuarioService->update($request, $id);

        if($usuario->getOriginalContent()['status'] == 'success'){

            $usuarioLogado = UtilHelper::getUsuario();

            if($usuarioLogado->hasPerfil('PRISMA-Gestor')){
                $instituicao = $this->instituicaoRepository->find($request['id_instituicao']);    
            }else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }

            $usuarioAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$request);

            $html = view('prisma::instituicoes.show._dados_responsavel', compact('instituicao'))->render(); 

            return response(['msg' => $usuario->getOriginalContent()['msg'], 'status' => 'success', 'html'=> $html]); 

        }

        return $usuario;
    }

    public function changeResponsavel($id) {
        $mode = "change";
        $usuario = $this->repository->find($id);
        $id_instituicao = $usuario->instituicaoPrisma->id_instituicao;

        $html = view('prisma::usuarios.responsavel._modal', compact('mode','id_instituicao'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function alterResponsavel(Request $request) {
        $usuarioLogado = UtilHelper::getUsuario();

        if($usuarioLogado->hasPerfil('PRISMA-Gestor')) {
            $instituicao = $this->instituicaoRepository->find($request['id_instituicao']);    
        }
        else {
            $instituicao = $usuarioLogado->instituicaoPrisma;
        }
        $responsavelAtual = $instituicao->responsavel->last();

        $responsavelAtual->delete();
        
        $usuario = $this->controleUsuarioService->store($request);

        $request['in_perfil'] = 'R';

        if($usuario->getOriginalContent()['status'] == 'success') {      
            if($usuarioLogado->hasPerfil('PRISMA-Gestor')) {
                $instituicao = $this->instituicaoRepository->find($request['id_instituicao']);    
            }
            else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }

            $perfilResponsavel = $this->controleUsuarioService->associarPerfil($request->nr_cpf,'PRISMA-ResponsavelInstituicao');
            $usuarioAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$request);

            if($usuarioLogado->hasPerfil('PRISMA-ResponsavelInstituicao')) {
                return response(['msg' => $usuario->getOriginalContent()['msg'], 'status' => 'logout', 'html'=> '']); 
            }

            $html = view('prisma::instituicoes.show._dados_responsavel', compact('instituicao'))->render(); 

            return response(['msg' => $usuario->getOriginalContent()['msg'], 'status' => 'success', 'html'=> $html]); 

        }    

        return $usuario;     
    }

    public function destroy($id)
    {
        try{

            $this->repository->find($id)->delete();
            $usuarios = $this->repository->findAllOrderByName();
            $html = view('sisadm::usuarios._tabela', compact('usuarios'))->render(); 
            return response(['msg' => 'Registro excluído com sucesso.', 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => 'Erro ao excluir o registro.', 'status' => 'error']);

        }
    }

    public function destroyEditor($id) {
        try {

            $usuario = $this->repository->find($id);
            $instituicaoPrisma = $usuario->instituicaoPrisma;
            $usuario->delete();
            $usuarioLogado = UtilHelper::getUsuario();

            if($usuarioLogado->hasPerfil('PRISMA-Gestor')) {
                $instituicao = $this->instituicaoRepository->find($instituicaoPrisma->id_instituicao);    
            }
            else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }

            $html = view('prisma::instituicoes.show._dados_editores', compact('instituicao'))->render(); 

            return response(['msg' => 'Registro excluído com sucesso.', 'status' => 'success', 'html'=> $html]);

        } catch(Exception $e) {
            return response(['msg' => 'Erro ao excluir o registro.', 'status' => 'error']);
        }
    }

    public function destroyResponsavel($id) {
        try {

            $usuario = $this->repository->find($id);
            $instituicaoPrisma = $usuario->instituicaoPrisma;
            $usuario->delete();
            $usuarioLogado = UtilHelper::getUsuario();

            if($usuarioLogado->hasPerfil('PRISMA-Gestor')) {
                $instituicao = $this->instituicaoRepository->find($instituicaoPrisma->id_instituicao);    
            }
            else {
                $instituicao = $usuarioLogado->instituicaoPrisma;
            }

            if($usuarioLogado->hasPerfil('PRISMA-ResponsavelInstituicao')) {
                return response(['msg' => 'Registro excluído com sucesso.', 'status' => 'logout', 'html'=> '']); 
            }

            $html = view('prisma::instituicoes.show._dados_responsavel', compact('instituicao'))->render(); 

            return response(['msg' => 'Registro excluído com sucesso.', 'status' => 'success', 'html'=> $html]);

        } catch(Exception $e) {
            \Log::info($e);
            return response(['msg' => 'Erro ao excluir o registro.', 'status' => 'error']);
        }
    }

    public function perfis($id)
    {

        //dd(UtilHelper::getSistema());
        $usuario = $this->repository->find($id);
        $perfis = $this->perfilRepository->all();
        $sistema = $this->sistemaRepository->findByNome(UtilHelper::getSistema());

        
        //Verifica quais perfis o usuário que está sendo alterado possui acesso.
        $perfilUsuario = array();
        foreach ($usuario->perfis as $perfil) {
            $perfilUsuario[] = $perfil->id_perfil;
        }

        return view('prisma::usuarios.perfis', compact('usuario', 'perfis', 'sistema','perfilUsuario'));

    }

    public function storePerfil(Request $request, $id)
    {
        $usuario = $this->repository->find($id);

        if(Auth::user()->hasRole('Administrador'))
        {
            $sistemas = $this->sistemaRepository->all();    
        }
        else
        {
            //Verifica quais sistemas o usuário que está acessando o portal possui perfil de Gestor.
            $gestorSistemas = new Collection;
            foreach (Auth::user()->perfis as $perfil) {

                if($perfil->no_perfil == $perfil->sistema->no_sistema.'-Gestor')
                {
                    $gestorSistemas->push($perfil->sistema);
                }

            }

            $sistemas = $gestorSistemas;
        }

        //Verifica quais perfis o usuário que está sendo alterado tem acesso e que são diferentes dos perfis que o Gestor possui acesso.
        $perfilUsuarioNaoAlterados = array();
        foreach ($usuario->perfis as $perfil) {
            if(!in_array($perfil->id_sistema,$sistemas->pluck(['id_sistema'])->toArray()))
            {
                $perfilUsuarioNaoAlterados[] = $perfil->id_perfil;
            }
        }

        //Combina o array com os perfis manipulados pelo Gestor e o array com os perfis que não podem ser acessados pelo Gestor.
        $perfilUsuarioAlterados = $request['perfis'];
        $request['perfis'] = array_merge($perfilUsuarioAlterados,$perfilUsuarioNaoAlterados);

        //Atualiza os perfis do usuário
        $this->repository->syncPerfis($usuario, $request['perfis']);

        return redirect()->route('prisma::usuarios.index')->with('message', trans('Perfil associado com sucesso.'));    
    }

}
