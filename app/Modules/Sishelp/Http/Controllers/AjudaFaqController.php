<?php

namespace App\Modules\Sishelp\Http\Controllers;

use App\Modules\Sishelp\Http\Requests\AjudaFaqRequest;
use App\Modules\Sishelp\Repositories\AjudaFaqRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjudaFaqController extends Controller
{
    
    protected $repository;
    protected $sistemaRepository;

    public function __construct(AjudaFaqRepository $repository, SistemaRepository $sistemaRepository )
    {
        $this->repository = $repository;
        $this->sistemaRepository = $sistemaRepository;
    }

    public function index()
    {
        $faqs = $this->repository->all();

        return view('sishelp::ajuda_faq.index', compact('faqs'));
    }

    public function create()
    {
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');

        return view('sishelp::ajuda_faq.create',compact('sistemas'));
    }

    public function store(AjudaFaqRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('sishelp::ajuda_faq.index');
    }

    public function edit($id)
    {
        $faq = $this->repository->find($id);
        $sistemas = $this->sistemaRepository->lists('no_sistema','id_sistema');
        return view('sishelp::ajuda_faq.edit', compact('faq','sistemas'));
    }

    public function update(AjudaFaqRequest $request, $id)
    {
        $this->repository->find($id)->update($request->all());
        return redirect()->route('sishelp::ajuda_faq.index');
    }

    public function destroy($id)
    {
        $this->repository->find($id)->delete();
        return redirect()->route('sishelp::ajuda_faq.index');
    }

}