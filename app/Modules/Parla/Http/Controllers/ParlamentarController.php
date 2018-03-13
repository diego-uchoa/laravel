<?php

namespace App\Modules\Parla\Http\Controllers;

use App\Modules\Parla\Http\Requests\ParlamentarRequest;
use App\Modules\Parla\Repositories\ParlamentarRepository;
use App\Modules\Parla\Repositories\FiliacaoPartidariaRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ParlamentarController extends Controller
{
    /** @var  ParlamentarRepository */
    private $parlamentarRepository;
    private $filiacaoPartidariaRepository;

    public function __construct(ParlamentarRepository $parlamentarRepository, FiliacaoPartidariaRepository $filiacaoPartidariaRepository)
    {
        $this->parlamentarRepository = $parlamentarRepository;
        $this->filiacaoPartidariaRepository = $filiacaoPartidariaRepository;
    }

    /**
     * Display a listing of the Parlamentar.
     *
     * @param Request $request
     */
    public function index()
    {
        return view('parla::parlamentares.index');
    }

    /**
     * Gera a datatable de parlamentares
     *
     * @param Request $request
     */
    public function list(Request $request)
    {
        $parlamentares = $this->parlamentarRepository->all();

        $canShow = false;

        if(\Entrust::can('parla::parlamentares.show')) {
            $canShow = true;
        }
        
        return Datatables::of($parlamentares)->with($canShow)
            ->addColumn('no_parlamentar', function ($parlamentar) use ($canShow) {
                if($canShow) {
                    return '<a parlamentar="'.$parlamentar->no_parlamentar.'" href="'.route('parla::parlamentares.show',['id'=>$parlamentar->id_parlamentar]).'">'.$parlamentar->no_parlamentar.'</a>';
                }
                else {
                    return $parlamentar->no_parlamentar;
                }
            })
            ->addColumn('in_cargo', function ($parlamentar) {
                return $parlamentar->in_cargo;
            })
            ->addColumn('sg_uf_parlamentar', function ($parlamentar) {
                return $parlamentar->sg_uf_parlamentar;
            })
            ->addColumn('sn_exercicio', function ($parlamentar) {
                return $parlamentar->sn_exercicio;
            })
            ->addColumn('posicionamento', function ($parlamentar) {
                if($parlamentar->in_posicionamento == 'O')
                    return '<span class="label label-danger">'.$parlamentar->no_posicionamento.'</span>';
                elseif($parlamentar->in_posicionamento == 'B')
                    return '<span class="label label-success">'.$parlamentar->no_posicionamento.'</span>';
                elseif($parlamentar->in_posicionamento == 'I')
                    return '<span class="label label-default">'.$parlamentar->no_posicionamento.'</span>';
            })
            

            ->addColumn('acoes', function ($parlamentar) use ($canShow) {
                if($canShow) {
                    return '<a href="'.route('parla::parlamentares.show',['id'=>$parlamentar->id_parlamentar]).'" class="btn btn-xs btn-success" data-rel="tooltip" data-original-title="Ver perfil"><i class="ace-icon fa fa-eye"></i></a>';
                }
                else {
                    return '';
                }
            })
            ->rawColumns(['no_parlamentar','posicionamento','acoes'])
            ->make(true);
    }


    /**
     * Show the details of the specified Parlamentar.
     *
     * @param  int $id
     *
     */
    public function show($id)
    {
        $parlamentar = $this->parlamentarRepository->find($id);

        return view('parla::parlamentares.show', compact('parlamentar'));
    }

    /**
     * Show the form for editing the specified Parlamentar.
     *
     * @param  int $id
     *
     */
    public function editPosicionamento($id)
    {
        $parlamentar = $this->parlamentarRepository->find($id);
        $mode = "update";

        $html = view('parla::parlamentares.posicionamento._modal', compact('parlamentar','mode'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }


    /**
     * Update the specified Parlamentar in storage.
     *
     * @param  int              $id
     * @param UpdateProposicaoRequest $request
     *
     * @return Response
     */
    public function updatePosicionamento($id, Request $request) {
            $this->parlamentarRepository->find($id)->update(array('in_posicionamento' => $request->input('in_posicionamento')));

            $parlamentar = $this->parlamentarRepository->find($id);

            $html = view('parla::parlamentares.show._dados_parlamentar', compact('parlamentar'))->render();

            return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);  
    }


    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        //recuperando os sistemas para renderizar a tabela
        $parlamentares = $this->parlamentarRepository->all();
        return view('parla::parlamentares._tabela', compact('parlamentares'))->render(); 
    }
}
