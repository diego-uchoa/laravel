<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Repositories\EventoRepository;
use App\Modules\Sisadm\Models\Evento;
use App\Modules\Sisadm\Http\Requests\EventoRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

class EventoController extends Controller
{
    
    protected $repository;
    
    public function __construct(EventoRepository $repository)
    {
        $this->repository = $repository;        
    }

    public function index()
    {
        $mode = "";
        $eventos = $this->repository->findAllOrderByName();

        return view('sisadm::evento.index', compact('eventos', 'mode'));
    }

    public function create()
    {
        $mode = "create";
        $datahora = "";

        $html = view('sisadm::evento._modal', compact('datahora', 'mode'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    public function store(EventoRequest $request)
    {
        $time = explode(" - ", $request->input('datahora'));

        $evento = new Evento();
        $evento->no_evento = $request->no_evento;
        $evento->ds_evento = $request->ds_evento;
        $evento->dt_inicio = $this->change_date_format($time[0]);
        $evento->dt_fim = $this->change_date_format($time[1]);
        $evento->tx_cor= 'red';
        $evento->sn_todo_dia = $request->sn_todo_dia;
        $evento->id_usuario = Auth::user()->id_usuario;
        $evento->save();

        //$this->repository->create($request->all());

        $html = $this->renderizarTabela();
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    
    }

    public function edit($id)
    {
        $mode = "update";
        $evento = $this->repository->find($id);    

        $datahora = $evento->dt_inicio->format('d/m/Y H:i:s') . ' - ' . $evento->dt_fim->format('d/m/Y H:i:s');

        $html = view('sisadm::evento._modal', compact('evento', 'mode', 'datahora'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    public function update(EventoRequest $request, $id)
    {
        $evento = $this->repository->find($id);

        $time = explode(" - ", $request->input('datahora'));
        $evento->no_evento = $request->no_evento;
        $evento->ds_evento = $request->ds_evento;
        $evento->dt_inicio = $this->change_date_format($time[0]);
        $evento->dt_fim = $this->change_date_format($time[1]);
        $evento->tx_cor= 'red';
        $evento->sn_todo_dia = $request->sn_todo_dia;
        $evento->id_usuario = Auth::user()->id_usuario;
        $evento->save();

        $html = $this->renderizarTabela();

        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    
    }

    public function destroy($id)
    {
        try{

            $this->repository->find($id)->delete();

            $html = $this->renderizarTabela();            
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.updatedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

    public function change_date_format($date)
    {
        $time = Carbon::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        //recuperando os Eventos para renderizar a tabela
        $eventos = $this->repository->findAllOrderByName();                
        return view('sisadm::evento._tabela', compact('eventos'))->render(); 
    }    
}