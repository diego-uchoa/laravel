<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Repositories\OrgaoRepository;
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
use MaskHelper;
use Illuminate\Support\Facades\Cache;
use App\Helpers\UtilHelper;

class UsuariosController extends Controller
{

    protected $repository;
    protected $orgaoRepository;
    protected $perfilRepository;
    protected $sistemaRepository;
    protected $userService;
    
    public function __construct(UserService $userService, UserRepository $repository, 
                                    OrgaoRepository $orgaoRepository, PerfilRepository $perfilRepository, SistemaRepository $sistemaRepository)
    {
        $this->userService = $userService;
        $this->repository = $repository;
        $this->orgaoRepository = $orgaoRepository;
        $this->perfilRepository = $perfilRepository;
        $this->sistemaRepository = $sistemaRepository;
    }

    public function index()
    {
        $mode = "criar";
        $listaOrgaos = $this->orgaoRepository->prepareListaSelect2ById(0);;
        return view('sisadm::usuarios.index', compact('mode', 'listaOrgaos'));
    }

    public function records(Request $request)
    {   
        $usuarios = $this->repository->findAllOrderByName();
        return Datatables::of($usuarios)
                
                ->addColumn('no_usuario', function ($usuario) {
                                return $usuario->no_usuario;
                            })
                ->addColumn('email', function ($usuario) {
                                return $usuario->email;
                            })

                ->addColumn('operacoes', function ($usuario) {
                    return "<a href=".url('sisadm/usuarios/perfis/'.$usuario->id_usuario.'')." class='btn btn-xs btn-default'>
                                Perfis
                            </a>
                            <a href='#' data-url=".url('sisadm/usuarios/edit/'.$usuario->id_usuario.'')." class='btn btn-xs btn-info update'>
                                <i class='ace-icon fa fa-pencil'></i>
                            </a>
                            <a href='#' data-id='{{ $usuario->id_usuario }}' data-url=".url('sisadm/usuarios/destroy/'.$usuario->id_usuario.'')." class='btn btn-xs btn-danger delete'>
                                <i class='ace-icon fa fa-trash-o'></i>
                            </a>   ";
                            })
                ->rawColumns(['operacoes'])
                ->make(true);
    }

    public function create()
    {
        $mode = "create";
        $listaOrgaos = $this->orgaoRepository->prepareListaSelect2ById(0);;
        $html = view('sisadm::usuarios._modal', compact('listaOrgaos', 'mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
        //return view('sisadm::usuarios.create', compact('listaOrgaos'));
    }

    public function store(UsuarioRequest $request)
    {   

        return $this->userService->store($request);     
        
    }

    public function edit($id)
    {
        $mode = "update";
        $usuario = $this->repository->find($id);
        $listaOrgaos = [$usuario->orgao->id_orgao => $usuario->orgao->sg_orgao ." - ". $usuario->orgao->no_orgao];
        $html = view('sisadm::usuarios._modal', compact('usuario', 'listaOrgaos', 'mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);

        //return view('sisadm::usuarios.edit', compact('usuario', 'listaOrgaos'));
    }

    public function update(UsuarioRequest $request, $id)
    {
        return $this->userService->update($request, $id);
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

    public function perfis($id)
    {
        $usuario = $this->repository->find($id);
        $perfis = $this->perfilRepository->all();

        if(Auth::user()->hasRole('SISADM-Administrador'))
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

        //Verifica quais perfis o usuário que está sendo alterado possui acesso.
        $perfilUsuario = array();
        foreach ($usuario->perfis as $perfil) {
            $perfilUsuario[] = $perfil->id_perfil;
        }

        return view('sisadm::usuarios.perfis', compact('usuario', 'perfis', 'sistemas','perfilUsuario'));

    }

    public function storePerfil(Request $request, $id)
    {
        $usuario = $this->repository->find($id);

        if(Auth::user()->hasRole('SISADM-Administrador'))
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

        //Combina o array com os perfis manipulados pelo Gestor e o array com os perfis que não estão listados para o Gestor alterar.
        $perfilUsuarioAlterados = $request['perfis'];
        $request['perfis'] = array_merge($perfilUsuarioAlterados,$perfilUsuarioNaoAlterados);

        //Atualiza os perfis do usuário
        $this->repository->syncPerfis($usuario, $request['perfis']);
        foreach ($sistemas as $sistema) {
            Cache::pull('menu-'.$sistema->no_sistema.'-'.UtilHelper::removeMascaraCpf($usuario->nr_cpf));
        }

        return redirect()->route('sisadm::usuarios.index')->with('message', trans('Perfil associado com sucesso.'));    
    }

    /**
     * Método responsável por verificar se o Usuário possui algum perfil do sistema informado.
     * @param string $nr_cpf
     * @param string $no_sistema
     * @return View
    */
    public function findUsuarioBySistema($nr_cpf, $no_sistema)
    {
        $retorno = [];
        $nr_cpf = MaskHelper::removeMascaraCpf($nr_cpf);
        $usuario = $this->repository->findBy([['nr_cpf', '=', $nr_cpf]])->first();
        if ($usuario){
            foreach ($usuario->perfis as $perfil) {

                if($perfil->sistema->no_sistema == $no_sistema)
                {
                    $retorno['id_usuario'] = $usuario->id_usuario;
                    $retorno['no_usuario'] = $usuario->no_usuario;
                    $retorno['email'] = $usuario->email;
                    $retorno['no_orgao'] = $usuario->orgao->no_orgao;
                }

            }    
        }

        return $retorno;
    }
}
