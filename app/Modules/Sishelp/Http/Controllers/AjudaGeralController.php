<?php

namespace App\Modules\Sishelp\Http\Controllers;

use App\Modules\Sishelp\Http\Requests\AjudaGeralRequest;
use App\Modules\Sishelp\Repositories\AjudaGeralRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjudaGeralController extends Controller
{
    
    protected $repository;
    protected $sistemaRepository;

    public function __construct(AjudaGeralRepository $repository, SistemaRepository $sistemaRepository )
    {
        $this->repository = $repository;
        $this->sistemaRepository = $sistemaRepository;
    }

    public function index()
    {
        $gerals = $this->repository->all();

        return view('sishelp::ajuda_geral.index', compact('gerals'));
    }

    public function create()
    {
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');

        return view('sishelp::ajuda_geral.create',compact('sistemas'));
    }

    public function store(AjudaGeralRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('sishelp::ajuda_geral.index');
    }

    public function edit($id)
    {
        $geral = $this->repository->find($id);
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');
        return view('sishelp::ajuda_geral.edit', compact('geral','sistemas'));
    }

    public function update(AjudaGeralRequest $request, $id)
    {
        $this->repository->find($id)->update($request->all());
        return redirect()->route('sishelp::ajuda_geral.index');
    }

    public function destroy($id)
    {
        $this->repository->find($id)->delete();
        return redirect()->route('sishelp::ajuda_geral.index');
    }

}