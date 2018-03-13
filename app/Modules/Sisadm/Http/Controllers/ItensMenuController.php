<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Http\Requests\ItemMenuRequest;
use App\Modules\Sisadm\Repositories\ItemMenuRepository;
use App\Modules\Sisadm\Repositories\OperacaoRepository;
use App\Modules\Sisadm\Repositories\SistemaRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItensMenuController extends Controller
{
    protected $repository;
    protected $operacaoRepository;
    protected $sistemaRepository;

    public function __construct(OperacaoRepository $operacaoRepository, 
        SistemaRepository $sistemaRepository, ItemMenuRepository $repository)
    {
        $this->repository = $repository;
        $this->operacaoRepository = $operacaoRepository;
        $this->sistemaRepository = $sistemaRepository;
    }

    public function index()
    {
        $itensMenu = $this->repository->findAllOrderByName();
        return view('sisadm::itens_menu.index', compact('itensMenu'));
    }

    public function create()
    {
        $itensMenu = $this->repository->findAllOrderByName();
        $sistemas = $this->sistemaRepository->findAllOrderByName();
        $operacoes = $this->operacaoRepository->findAllOrderByName();
        return view('sisadm::itens_menu.create',compact('sistemas','operacoes','itensMenu'));
    }

    public function store(ItemMenuRequest $request)
    {
        if($request->input('tipo') == 'raiz'){
            $request['rota'] = 'portal.inicio';
        }

        if($request->input('tipo') == 'submenu'){
            
            $ordemMenuPrecedente = $this->repository->find($request['id_item_menu_precedente'])->ordem;
            
            $ordemAjustada = $ordemMenuPrecedente.$request['ordem'];

            $request['ordem'] = $ordemAjustada;
               
        }

        $this->repository->create($request->all());
        return redirect()->route('sisadm::itens_menu.index')->with('message', trans('alerts.registro.created'));
    }

    public function edit($id)
    {
        $itemMenu = $this->repository->find($id);

        if($itemMenu->tipo == 'submenu'){
            
            $ordemMenuPrecedente = $this->repository->find($itemMenu->id_item_menu_precedente)->ordem;
            
            $ordemAjustada = substr($itemMenu->ordem,strlen($ordemMenuPrecedente));
           
            $itemMenu->ordem = $ordemAjustada;
               
        }

        $itensMenu = $this->repository->findAllOrderByName();
        $sistemas = $this->sistemaRepository->findAllOrderByName();
        $operacoes = $this->operacaoRepository->findAllOrderByName();

        return view('sisadm::itens_menu.edit', compact('itemMenu','sistemas','operacoes','itensMenu'));
    }

    public function update(ItemMenuRequest $request, $id)
    {
        if($request->input('itemMenuPrecedente') == ''){
            $request['itemMenuPrecedente'] = NULL;
        }

        if($request->input('tipo') == 'submenu'){
            
            $ordemMenuPrecedente = $this->repository->find($request['id_item_menu_precedente'])->ordem;
            
            $ordemAjustada = $ordemMenuPrecedente.$request['ordem'];

            $request['ordem'] = $ordemAjustada;
               
        }

        $this->repository->find($id)->update($request->all());
        return redirect()->route('sisadm::itens_menu.index')->with('message', trans('alerts.registro.updated'));
    }

    public function destroy($id)
    {
        try{

            $this->repository->find($id)->delete();
            $itensMenu = $this->repository->findAllOrderByName();
            $html = view('sisadm::itens_menu._tabela', compact('itensMenu'))->render(); 
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        //recuperando os Itens de Menu para renderizar a tabela
        $itensMenu = $this->repository->findAllOrderByName();
        return view('sisadm::itens_menu._tabela', compact('itensMenu'))->render(); 
    }
}
