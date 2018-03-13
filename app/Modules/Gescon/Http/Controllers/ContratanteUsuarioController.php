<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\ContratanteUsuarioRequest;
use App\Modules\Gescon\Repositories\ContratanteUsuarioRepository;
use App\Modules\Gescon\Repositories\ContratanteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContratanteUsuarioController extends Controller
{
    private $contratanteUsuarioRepository;
    private $contratanteRepository;

    public function __construct(ContratanteUsuarioRepository $contratanteUsuarioRepository,
                                    ContratanteRepository $contratanteRepository)
    {
        $this->contratanteUsuarioRepository = $contratanteUsuarioRepository;
        $this->contratanteRepository = $contratanteRepository;
    }

    /**
     * Mostre o formulário para criar um novo Usuário.
     *
     */
    public function create($id_contratante)
    {   
        $mode = "create";

        $html = view('gescon::contratantes.usuario._modal')->with('id_contratante', $id_contratante)->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Associa um Usuario recentemente criado ao Contratante.
     *
     * @param ContratanteUsuarioRequest $request
     *
     */
    public function store(ContratanteUsuarioRequest $request)
    {
        $contratanteUsuarioDeletado = $this->contratanteUsuarioRepository->findDeleted([['id_usuario', '=', $request->id_usuario], ['id_contratante', '=', $request->id_contratante]]);
        if (count($contratanteUsuarioDeletado) > 0){

            $this->contratanteUsuarioRepository->restoreDeleted([['id_usuario', '=', $request->id_usuario], ['id_contratante', '=', $request->id_contratante]]);

        }else{

            $contratanteUsuario = $this->contratanteUsuarioRepository->findBy([['id_usuario', '=', $request->id_usuario], ['id_contratante', '=', $request->id_contratante]]);    
            if (count($contratanteUsuario) > 0){

                $html = $this->renderizarTabela($request->id_contratante);
                return response(['msg' => 'O usuário informado já está associado a esta UASG.', 'status' => 'success', 'html'=> $html]);    

            }else{

                $request->request->add(['id_contratante' => $request->id_contratante]);
                $this->contratanteUsuarioRepository->create($request->all());

            }
        }

        $html = $this->renderizarTabela($request->id_contratante);
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Realiza o desligamento do Usuario de um Contratante específico.
     *
     * @param  int $id
     * @param  int $id_contratante
     *
     * @return Response
     */
    public function destroy_usuario($id, $id_contratante)
    {
        try{
            
            $this->contratanteUsuarioRepository->delete($id);
            $html = $this->renderizarTabela($id_contratante);
            
            return response(['msg' => 'Usuário foi desvinculado com sucesso.', 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

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
        return view('gescon::contratantes.usuario._tabela_usuarios', compact('contratante'))->render(); 
    }
}

