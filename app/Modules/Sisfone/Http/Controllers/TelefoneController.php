<?php

namespace App\Modules\Sisfone\Http\Controllers;

use App\Modules\Sisfone\Http\Requests\TelefoneRequest;

use App\Modules\Sisfone\Repositories\TelefoneRepository;
use App\Modules\Sisfone\Repositories\TipoTelefoneRepository;

//SISADM
use App\Modules\Sisadm\Repositories\UserRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Gate;
use Auth;
use PDF;

class TelefoneController extends Controller
{

    protected $repository;
    protected $tipoTelefoneRepository;
    protected $usuarioRepository;


    public function __construct(TelefoneRepository $repository, TipoTelefoneRepository $tipoTelefoneRepository, UserRepository $usuarioRepository)
    {
        $this->repository = $repository;
        $this->tipoTelefoneRepository = $tipoTelefoneRepository;
        $this->usuarioRepository = $usuarioRepository;
    }

    public function index()
    {

        $telefones = $this->repository->all();    

        return view('sisfone::telefone.index', compact('telefones'));
    }

    public function create()
    {
        $tipos = $this->tipoTelefoneRepository->lists('no_tipo_telefone','id_tipo_telefone');

        if (Auth::user()->hasPerfil('SISFONE-Administrador'))
        {
            $usuarios = $this->usuarioRepository->lists('no_usuario','id_usuario');    
        } 
        else
        {
         $usuarios = $this->usuarioRepository->listsByAttribute('no_usuario','id_usuario','id_usuario', Auth::user()->id_usuario);
     }

     return view('sisfone::telefone.create',compact('tipos','sistemas','usuarios'));
 }

 public function store(TelefoneRequest $request)
 {
    $this->repository->create($request->all());
    return redirect()->route('sisfone::telefone.index')->with('message',trans('alerts.registro.created'));
}

public function edit($id)
{
    $telefone = $this->repository->find($id);
    $tipos = $this->tipoTelefoneRepository->lists('no_tipo_telefone','id_tipo_telefone');
    $usuarios = $this->usuarioRepository->lists('no_usuario','id_usuario');

    if(Gate::denies('update', $telefone)) {
      return redirect()->route('sisfone::telefone.index')->with('warning', 'Erro! Esse não é o seu telefone para atualizar.');
  }

  return view('sisfone::telefone.edit', compact('telefone','tipos','sistemas','usuarios'));
}

public function update(TelefoneRequest $request, $id)
{
    $this->repository->find($id)->update($request->all());
    return redirect()->route('sisfone::telefone.index')->with('message',trans('alerts.registro.updated'));
}

public function destroy($id)
{
    $telefone = $this->repository->find($id);

   if(Gate::denies('update', $telefone)) {
      return redirect()->route('sisfone::telefone.index')->with('warning', 'Erro! Esse não é o seu telefone para atualizar.');
   }

  $telefone->delete();

  return redirect()->route('sisfone::telefone.index')->with('message',trans('alerts.registro.deleted'));
}

public function listaTelefonica()
{
    $telefones = $this->repository->all();

    return view('sisfone::telefone.lista-telefonica', compact('telefones'));
}

public function listaTelefonicaPDF()
{
      $telefones = $this->repository->all();    
      $pdf = PDF::loadView('sisfone::telefone.lista-telefonica-pdf', compact('telefones'));
      return $pdf->download('lista_telefonica.pdf');
}

}