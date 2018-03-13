<?php

namespace App\Modules\Sishelp\Http\Controllers;

use App\Modules\Sishelp\Http\Requests\AjudaArquivoRequest;
use App\Modules\Sishelp\Repositories\AjudaArquivoRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;

use App\Modules\Sishelp\Services\AjudaArquivoService;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Sishelp\Models\AjudaArquivo;

class AjudaArquivoController extends Controller
{
    
    protected $repository;
    protected $sistemaRepository;

    protected $ajudaArquivoService;

    public function __construct(AjudaArquivoRepository $repository, SistemaRepository $sistemaRepository, AjudaArquivoService $ajudaArquivoService)
    {
        $this->repository = $repository;
        $this->sistemaRepository = $sistemaRepository;
        $this->ajudaArquivoService = $ajudaArquivoService;
    }

    public function index()
    {
        $arquivos = $this->repository->all();

        return view('sishelp::ajuda_arquivo.index', compact('arquivos'));
    }

    public function create()
    {
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');

        return view('sishelp::ajuda_arquivo.create',compact('sistemas'));
    }

    public function store(AjudaArquivoRequest $request)
    {
        
        $this->ajudaArquivoService->addAjudaArquivo($request);

        //$this->repository->create($request->all());

        return redirect()->route('sishelp::ajuda_arquivo.index');
    }

    public function edit($id)
    {
        $arquivo = $this->repository->find($id);
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');
        return view('sishelp::ajuda_arquivo.edit', compact('arquivo','sistemas'));
    }

    public function update(AjudaArquivoRequest $request, $id)
    {
        $this->repository->find($id)->update($request->all());
        return redirect()->route('sishelp::ajuda_arquivo.index');
    }

    public function destroy($id)
    {
        $this->repository->find($id)->delete();
        return redirect()->route('sishelp::ajuda_arquivo.index');
    }   

}