<?php

namespace App\Modules\Parla\Http\Controllers;

use App\Modules\Parla\Http\Requests\ComissaoRequest;
use App\Modules\Parla\Repositories\ComissaoRepository;
use App\Modules\Parla\Repositories\ParlamentarRepository;
use App\Http\Controllers\Controller;
use Charts;
use Illuminate\Http\Request;

class ComissaoController extends Controller
{
    /** @var  ComissaoRepository */
    private $comissaoRepository;
    private $parlamentarRepository;

    public function __construct(ComissaoRepository $comissaoRepository, ParlamentarRepository $parlamentarRepository)
    {
        $this->comissaoRepository = $comissaoRepository;
        $this->parlamentarRepository = $parlamentarRepository;
    }

    /**
     * Exibir uma listagem do Comissao.
     *
     */
    public function index()
    {
        $comissoes = $this->comissaoRepository->all();
        
        return view('parla::comissoes.index', compact('comissoes'));
    }

    /**
     * Mostre o formulário para criar um novo Comissao.
     *
     */
    public function create()
    {   
        
        return view('parla::comissoes.create');

    }

    /**
     * Insere um Comissao recentemente criado.
     *
     * @param ComissaoRequest $request
     *
     */
    public function store(ComissaoRequest $request)
    {

        $this->comissaoRepository->create($request->all());

        return redirect()->route('parla::comissoes.index')->with('message', trans('alerts.registro.created'));

    }

    /**
     * Mostra detalhes de uma comissao especificada
     *
     * @param  int $id
     *
     */
    public function show($id)
    {
        $comissao = $this->comissaoRepository->find($id);
        $membro = json_decode('{"id_parlamentar":0,"no_parlamentar":"","pivot":{"id_comissao":0}}');
        $origin = '';

        $titulares = Charts::create('pie', 'highcharts')
            ->colors(['#9abc32','#d53f40','#999','#6fb3e0'])
            ->title("Posicionamento - Titulares")
            ->labels(['Base', 'Oposição','Indefinido','Não informado'])
            ->height(300)
            ->values([
                $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','B')->count(),
                $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','O')->count(),
                $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','I')->count(),
                $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao',null)->count()
            ]);

        $suplentes = Charts::create('pie', 'highcharts')
            ->colors(['#9abc32','#d53f40','#999','#6fb3e0'])
            ->title("Posicionamento - Suplentes")
            ->labels(['Base', 'Oposição','Indefinido','Não informado'])
            ->height(300)
            ->values([
                $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','B')->count(),
                $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','O')->count(),
                $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','I')->count(),
                $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao',null)->count()
            ]);

        $membros = Charts::create('pie', 'highcharts')
            ->colors(['#9abc32','#d53f40','#999','#6fb3e0'])
            ->title("Posicionamento - Todos os membros")
            ->labels(['Base', 'Oposição','Indefinido','Não informado'])
            ->height(300)
            ->values([
                $comissao->membros->where('pivot.in_posicionamento_comissao','B')->count(),
                $comissao->membros->where('pivot.in_posicionamento_comissao','O')->count(),
                $comissao->membros->where('pivot.in_posicionamento_comissao','I')->count(),
                $comissao->membros->where('pivot.in_posicionamento_comissao',null)->count()
            ]);

        return view('parla::comissoes.show', compact('comissao','titulares','suplentes','membros','membro','origin'));
    }

    /**
     * Mostra o formulário para editar um Comissao especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $comissao = $this->comissaoRepository->find($id);

        return view('parla::comissoes.edit', compact('comissao'));
    }

    /**
     * Atualiza um Comissao especificado.
     *
     * @param int $id
     * @param ComissaoRequest $request
     *
     * @return Response
     */
    public function update($id, ComissaoRequest $request)
    {
        try{
            
            $this->comissaoRepository->find($id)->update($request->all());

            return redirect()->route('parla::comissoes.index')->with('message', trans('alerts.registro.updated'));    

        }catch(\Exception $e){
            
            $messagesExceptions = [
               'exception' => 'Erro '. $e->getCode() .' : ', 
               'message_exception' => $e->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions, $e->getCode());

        }
    }


    /**
     * Remove um Comissao específico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->comissaoRepository->find($id)->delete();
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }

    /**
     * Edita posicionamento do parlamentar na comissão
     *
     * @param  int $id
     *
     */
    public function editPosicionamento($id_comissao, $id_parlamentar, $origin)
    {
        $membro = $this->comissaoRepository->find($id_comissao)->membros->where('pivot.id_parlamentar',$id_parlamentar)->first();
        $mode = "update";

        $html = view('parla::comissoes.composicao.posicionamento._modal', compact('membro','mode','origin'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Atualiza posicionamento do parlamentar na comissão
     *
     */
    public function updatePosicionamento($id_comissao, $id_parlamentar, $origin, Request $request) {
        if($origin == 'composicao') {
            $this->comissaoRepository->find($id_comissao)->membros()->updateExistingPivot($id_parlamentar, array('in_posicionamento_comissao' => $request->input('in_posicionamento')));

            $comissao = $this->comissaoRepository->find($id_comissao);

            $titulares = Charts::create('pie', 'highcharts')
                ->colors(['#9abc32','#d53f40','#999','#6fb3e0'])
                ->title("Posicionamento - Titulares")
                ->labels(['Base', 'Oposição','Indefinido','Não informado'])
                ->height(300)
                ->values([
                    $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','B')->count(),
                    $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','O')->count(),
                    $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao','I')->count(),
                    $comissao->membros->where('pivot.in_cargo','T')->where('pivot.in_posicionamento_comissao',null)->count()
                ]);

            $suplentes = Charts::create('pie', 'highcharts')
                ->colors(['#9abc32','#d53f40','#999','#6fb3e0'])
                ->title("Posicionamento - Suplentes")
                ->labels(['Base', 'Oposição','Indefinido','Não informado'])
                ->height(300)
                ->values([
                    $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','B')->count(),
                    $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','O')->count(),
                    $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao','I')->count(),
                    $comissao->membros->where('pivot.in_cargo','S')->where('pivot.in_posicionamento_comissao',null)->count()
                ]);

            $membros = Charts::create('pie', 'highcharts')
                ->colors(['#9abc32','#d53f40','#999','#6fb3e0'])
                ->title("Posicionamento - Todos os membros")
                ->labels(['Base', 'Oposição','Indefinido','Não informado'])
                ->height(300)
                ->values([
                    $comissao->membros->where('pivot.in_posicionamento_comissao','B')->count(),
                    $comissao->membros->where('pivot.in_posicionamento_comissao','O')->count(),
                    $comissao->membros->where('pivot.in_posicionamento_comissao','I')->count(),
                    $comissao->membros->where('pivot.in_posicionamento_comissao',null)->count()
                ]);

            $html = view('parla::comissoes.composicao._tabela', compact('comissao'))->render();
            $html2 = view('parla::comissoes.composicao._estatisticas', compact('comissao'))->render();
            $html3 = view('parla::comissoes.composicao._graficos', compact('titulares','suplentes','membros'))->render();

            return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html, 'html2'=> $html2, 'html3'=> $html3]);  
        }
        else if($origin == 'perfil_parlamentar') {
            $this->comissaoRepository->find($id_comissao)->membros()->updateExistingPivot($id_parlamentar, array('in_posicionamento_comissao' => $request->input('in_posicionamento')));

            $parlamentar = $this->parlamentarRepository->find($id_parlamentar);

            $html = view('parla::parlamentares.show._comissoes', compact('parlamentar'))->render();

            return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);  
        }
    }


    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        $comissoes = $this->comissaoRepository->all();
        return view('parla::comissoes._tabela', compact('comissoes'))->render(); 
    }
}
