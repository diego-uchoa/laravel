<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Http\Requests\AvisoSistemaRequest;

use App\Modules\Sisadm\Repositories\AvisoSistemaRepository;
use App\Modules\Sisadm\Repositories\TipoAvisoSistemaRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cache;
use App\Helpers\UtilHelper;

class AvisoSistemaController extends Controller
{
    
    protected $repository;
    protected $tipoAvisoSistemaRepository;
    protected $sistemaRepository;

    public function __construct(AvisoSistemaRepository $repository, TipoAvisoSistemaRepository $tipoAvisoSistemaRepository, SistemaRepository $sistemaRepository )
    {
        $this->repository = $repository;
        $this->tipoAvisoSistemaRepository = $tipoAvisoSistemaRepository;
        $this->sistemaRepository = $sistemaRepository;
    }

    public function index()
    {
        $mode = "";
        $avisos = $this->repository->findAllOrderByName();

        return view('sisadm::aviso_sistema.index', compact('avisos', 'mode'));
    }

    public function create()
    {
        $mode = "create";
        $tipos = $this->tipoAvisoSistemaRepository->lists('no_tipo_aviso_sistema','id_tipo_aviso_sistema');
        $sistemas = $this->sistemaRepository->listsOpcional('no_sistema','id_sistema');
        $html = view('sisadm::aviso_sistema._modal', compact('tipos', 'sistemas', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function store(AvisoSistemaRequest $request)
    {
        $aviso = $this->repository->create($request->all());
        $idSistema =  $aviso->id_sistema;

        //Limpa o cache do sistema
        $this->atualizaAvisoSistemaCache($idSistema);

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);
    }

    public function edit($id)
    {
        $mode = "update";
        $aviso = $this->repository->find($id);
        $tipos = $this->tipoAvisoSistemaRepository->lists('no_tipo_aviso_sistema','id_tipo_aviso_sistema');
        $sistemas = $this->sistemaRepository->listsOpcional('no_sistema','id_sistema');
        $html = view('sisadm::aviso_sistema._modal', compact('aviso','sistemas', 'tipos', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function update(AvisoSistemaRequest $request, $id)
    {
        $avisoAntes = $this->repository->find($id);
        $this->repository->find($id)->update($request->all());

        $avisoDepois = $this->repository->find($id);

        $idSistemaAntes = $avisoAntes->id_sistema;
        $idSistemaDepois = $avisoDepois->id_sistema;

        //Limpa o cache do sistema anterior e atualiza o depois
        $this->limpaAvisoSistemaCache($idSistemaAntes);
        $this->atualizaAvisoSistemaCache($idSistemaDepois);

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);
    }

    public function destroy($id)
    {
        try{

            $avisoAntes = $this->repository->find($id);
            $idSistemaAntes = $avisoAntes->id_sistema;

            $avisoAntes->delete();

            //Limpa o cache do sistema
            $this->limpaAvisoSistemaCache($idSistemaAntes);
            $this->atualizaAvisoSistemaCache($idSistemaAntes);

            $html = $this->renderizarTabela();            
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }


    private function limpaAvisoSistemaCache($idSistema)
    {
        if($idSistema === NULL) {

            Cache::forget('menu-avisos-sistemas-geral');
            Cache::forget('qtd-avisos-sistemas-geral');
        }
        else {

            $sistema = $this->sistemaRepository->getNomeSistemaById($idSistema);

            Cache::forget('menu-avisos-sistemas-'.$sistema);
            Cache::forget('qtd-avisos-sistemas-'.$sistema); 
        }
    }


    private function atualizaAvisoSistemaCache($idSistema)
    {        
        if($idSistema === NULL) {

            $avisoGeral = $this->repository->geraAvisoSistemaDestaqueGeral();
            Cache::put('menu-avisos-sistemas-geral', $avisoGeral, 60); 

            $qtdAvisoGeral = $this->repository->qtdAvisoSistemaDestaqueGeral();
            Cache::put('qtd-avisos-sistemas-geral', $qtdAvisoGeral,60);       
            
        }
        else {

           $sistema = $this->sistemaRepository->getNomeSistemaById($idSistema);
           
           $aviso = $this->repository->geraAvisoSistemaDestaque($sistema);
           Cache::put('menu-avisos-sistemas-'.$sistema, $aviso, 60);

           $qtdAviso = $this->repository->qtdAvisoSistemaDestaque($sistema);
           Cache::put('qtd-avisos-sistemas-'.$sistema, $qtdAviso,60);       
        }    
    }

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        //recuperando os Avisos de Sistema para renderizar a tabela
        $avisos = $this->repository->findAllOrderByName();                
        return view('sisadm::aviso_sistema._tabela', compact('avisos'))->render(); 
    }
}