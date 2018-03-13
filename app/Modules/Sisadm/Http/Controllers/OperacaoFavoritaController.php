<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Http\Requests\OperacaoFavoritaRequest;

use App\Modules\Sisadm\Repositories\OperacaoFavoritaRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;
use App\Modules\Sisadm\Repositories\OperacaoRepository;
use App\Modules\Sisadm\Repositories\UserRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Helpers\UtilHelper;

class OperacaoFavoritaController extends Controller
{
    
    protected $repository;
    protected $sistemaRepository;
    protected $usuarioRepository;
    protected $operacaoRepository;
    
    public function __construct(OperacaoFavoritaRepository $repository, SistemaRepository $sistemaRepository, UserRepository $usuarioRepository, OperacaoRepository $operacaoRepository)
    {
        $this->repository = $repository; 
        $this->sistemaRepository = $sistemaRepository;
        $this->usuarioRepository = $usuarioRepository;       
        $this->operacaoRepository = $operacaoRepository;
    }

    public function index()
    {    
       $usuario = UtilHelper::getUsuario();
       $username = UtilHelper::getUsername();

       //Busca operações que possui permissão
       $operacoes = $this->operacaoRepository->filterByUsuario($username);

       //dd($operacoes);
       
       //Busca operações favoritas já selecionadas
       $operacoes_favoritas = $this->repository->operacoesFavoritas($usuario->id_usuario);

       return view('sisadm::operacao_favorita.index', compact('operacoes_favoritas','operacoes'));       
    }

    public function create()
    {
        
        //
    }

    public function store(Request $request)
    {
        $request['id_usuario'] = UtilHelper::getUsuario()->id_usuario;
        $ids_operacoes = $request['ids_operacoes'];

        $this->repository->deleteByUsuario($request['id_usuario']);

        if(is_array($ids_operacoes)) {

          foreach ($ids_operacoes as $id_operacao) {

             $id_operacao = intval($id_operacao);

             $operacao = $this->operacaoRepository->find($id_operacao);

             $request['id_operacao'] = $operacao->id_operacao;
             $request['id_sistema'] = $operacao->sistema->id_sistema;

             $this->repository->create($request->all());                       
          }
        }
        
        return redirect()->route('sisadm::operacao_favorita.index')->with('message',trans('alerts.registro.updated'));
    }

    public function edit($id)
    {
        //
    }

    public function update(OperacaoFavoritaRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}