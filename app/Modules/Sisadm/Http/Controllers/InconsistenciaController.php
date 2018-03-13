<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Repositories\InconsistenciaRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InconsistenciaController extends Controller
{
    
    protected $repository;
    
    public function __construct(InconsistenciaRepository $repository)
    {
        $this->repository = $repository;        
    }

    public function index()
    {
        $inconsistencias = $this->repository->all();

        return view('sisadm::inconsistencia.index', compact('inconsistencias'));
    }

    public function verifica()
    {
        $this->repository->verificaInconsistencias();

        return redirect()->route('sisadm::inconsistencia.index')->with('message','Inconsistências Verificadas');
    }

    public function limpa()
    {

        $this->repository->limpaInconsistencias();

        return redirect()->route('sisadm::inconsistencia.index')->with('message','Inconsistências Deletadas');
    }

    public function destroy($id)
    {
        $this->repository->find($id)->delete();
        
        return redirect()->route('sisadm::inconsistencia.index')->with('message',trans('alerts.registro.deleted'));
    }

}