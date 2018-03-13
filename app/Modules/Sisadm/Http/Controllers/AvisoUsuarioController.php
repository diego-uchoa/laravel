<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Http\Requests\AvisoUsuarioRequest;

use App\Modules\Sisadm\Repositories\AvisoUsuarioRepository;
use App\Modules\Sisadm\Repositories\TipoAvisoUsuarioRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;
use App\Modules\Sisadm\Repositories\UserRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cache;
use App\Helpers\UtilHelper;


class AvisoUsuarioController extends Controller
{
    
    protected $repository;
    protected $tipoAvisoUsuarioRepository;
    protected $sistemaRepository;
    protected $usuarioRepository;


    public function __construct(AvisoUsuarioRepository $repository, TipoAvisoUsuarioRepository $tipoAvisoUsuarioRepository,SistemaRepository $sistemaRepository, UserRepository $usuarioRepository)
    {
        $this->repository = $repository;
        $this->tipoAvisoUsuarioRepository = $tipoAvisoUsuarioRepository;
        $this->sistemaRepository = $sistemaRepository;
        $this->usuarioRepository = $usuarioRepository;
    }

    public function index()
    {
        $mode = "";
        $avisos = $this->repository->findAllOrderByName();

        return view('sisadm::aviso_usuario.index', compact('avisos', 'mode'));
    }

    public function create()
    {
        $mode = "create";
        $tipos = $this->tipoAvisoUsuarioRepository->lists('no_tipo_aviso_usuario','id_tipo_aviso_usuario');
        $sistemas = $this->sistemaRepository->listsOpcional('no_sistema','id_sistema');
        $usuarios = $this->usuarioRepository->lists('no_usuario','id_usuario');
        $html = view('sisadm::aviso_usuario._modal', compact('tipos','sistemas','usuarios', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function store(AvisoUsuarioRequest $request)
    {
        $aviso = $this->repository->create($request->all());
        $idUsuario =  $aviso->id_usuario;
        $idSistema =  $aviso->id_sistema;

        //Alterar o cache
        $this->atualizaAvisoUsuarioCache($idUsuario,$idSistema);

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    
    }

    public function edit($id)
    {
        $mode = "update";
        
        $aviso = $this->repository->find($id);
        $tipos = $this->tipoAvisoUsuarioRepository->lists('no_tipo_aviso_usuario','id_tipo_aviso_usuario');
        $sistemas = $this->sistemaRepository->listsOpcional('no_sistema','id_sistema');
        $usuarios = $this->usuarioRepository->lists('no_usuario','id_usuario');
        $html = view('sisadm::aviso_usuario._modal', compact('aviso','tipos','sistemas','usuarios', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    public function update(AvisoUsuarioRequest $request, $id)
    {
        $avisoAntes = $this->repository->find($id);

        $this->repository->find($id)->update($request->all());

        $avisoDepois = $this->repository->find($id);

        $idUsuarioAntes =  $avisoDepois->id_usuario;
        $idSistemaAntes =  $avisoDepois->id_sistema;

        $idUsuarioDepois =  $avisoDepois->id_usuario;
        $idSistemaDepois =  $avisoDepois->id_sistema;

        //Alterar o cache
        $this->limpaAvisoSistemaCache($idUsuarioAntes,$idSistemaAntes);
        $this->atualizaAvisoUsuarioCache($idUsuarioDepois,$idSistemaDepois);

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }

    public function destroy($id)
    {
        try{

            $aviso = $this->repository->find($id);

            $idUsuario =  $aviso->id_usuario;
            $idSistema =  $aviso->id_sistema;

            $aviso->delete();

            //Alterar o cache
            $this->atualizaAvisoUsuarioCache($idUsuario,$idSistema);

            $html = $this->renderizarTabela();            
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

    private function limpaAvisoSistemaCache($idUsuario,$idSistema)
    {
        $usuario = $this->usuarioRepository->getCpfById($idUsuario);

        if($idSistema === NULL) {

            Cache::forget('menu-avisos-usuarios-geral-'.$usuario);
            Cache::forget('qtd-avisos-usuarios-geral-'.$usuario);

        }
        else {

            $sistema = $this->sistemaRepository->getNomeSistemaById($idSistema);

            Cache::forget('menu-avisos-usuarios-'.$sistema);                        
            Cache::forget('qtd-avisos-usuarios-'.$sistema);
        }
    }

    private function atualizaAvisoUsuarioCache($idUsuario,$idSistema)
    {
        
        $usuario = $this->usuarioRepository->getCpfById($idUsuario);

        if($idSistema === NULL) {

            $avisoGeral = $this->repository->geraAvisoUsuarioGeral($usuario);
            Cache::put('menu-avisos-usuarios-geral-'.$usuario, $avisoGeral, 60); 

            $qtdAvisoGeral = $this->repository->qtdAvisosNaoLidosGeral($usuario);
            Cache::put('qtd-avisos-usuarios-geral-'.$usuario, $qtdAvisoGeral,60);       
            
        }
        else {

           $sistema = $this->sistemaRepository->getNomeSistemaById($idSistema);

           $aviso = $this->repository->geraAvisoUsuario($usuario,$sistema);
           Cache::put('menu-avisos-usuarios-'.$sistema.'-'.$usuario, $aviso, 60);
           
           $qtdAviso = $this->repository->qtdAvisosNaoLidos($usuario,$sistema);
           Cache::put('qtd-avisos-usuarios-'.$sistema.'-'.$usuario, $qtdAviso,60);       
        }  
    }
    
    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        //recuperando os Avisos do Usuario para renderizar a tabela
        $avisos = $this->repository->findAllOrderByName();                
        return view('sisadm::aviso_usuario._tabela', compact('avisos'))->render(); 
    }    
}