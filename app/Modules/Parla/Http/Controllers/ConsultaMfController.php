<?php

namespace App\Modules\Parla\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Modules\Parla\Http\Requests\ConsultaMfRequest;
use App\Modules\Parla\Repositories\ConsultaMfRepository;
use App\Http\Controllers\Controller;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Modules\Parla\Repositories\TipoConsultaRepository;
use App\Modules\Parla\Repositories\TipoPosicaoRepository;
use App\Modules\Parla\Repositories\ProposicaoRepository;
use App\Modules\Parla\Repositories\ComissaoRepository;
use Symfony\Component\HttpFoundation\Response;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Charts;
use Yajra\Datatables\Datatables;

class ConsultaMfController extends Controller
{
    
    private $consultaMfRepository;
    protected $orgaoRepository;
    protected $tipoConsultaRepository;
    protected $tipoPosicaoRepository;
    protected $proposicaoRepository;
    protected $comissaoRepository;
    const SISTEMA = "PARLA";

    public function __construct(ConsultaMfRepository $consultaMfRepository, OrgaoRepository $orgaoRepository, TipoConsultaRepository $tipoConsultaRepository, TipoPosicaoRepository $tipoPosicaoRepository, ProposicaoRepository $proposicaoRepository, ComissaoRepository $comissaoRepository)
    {
        $this->consultaMfRepository = $consultaMfRepository;
        $this->orgaoRepository = $orgaoRepository;
        $this->tipoConsultaRepository = $tipoConsultaRepository;
        $this->tipoPosicaoRepository = $tipoPosicaoRepository;
        $this->proposicaoRepository = $proposicaoRepository;
        $this->comissaoRepository = $comissaoRepository;
    }

    /**
     * Display a listing of the ConsultaMf.
     *
     * @param Request $request
     */
    public function index()
    {
        $mode = "";
        $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
        $listaComissoes = $this->comissaoRepository->preparaListaComissoes();
        $listaTiposConsulta = $this->tipoConsultaRepository->preparaListaTiposConsulta();
        $listaTiposPosicao = $this->tipoPosicaoRepository->preparaListaTiposPosicao();
        
        return view('parla::consultas_mf.index', compact('mode','listaProposicoes','listaOrgaos','listaComissoes','listaTiposConsulta','listaTiposPosicao','ultimaComissao'));
    }

    /**
     * Gera a datatable de consultas
     *
     * @param Request $request
     */
    public function list(Request $request)
    {
        $consultasMf = $this->consultaMfRepository->all();

        $canEdit = false;
        $canDestroy = false;
        if(\Entrust::can('parla::consultasMf.edit')) {
            $canEdit = true;
        }

        if(\Entrust::can('parla::consultasMf.destroy')) {
            $canDestroy = true;
        }
        
        return Datatables::of($consultasMf)->with($canEdit,$canDestroy)
            ->addColumn('proposicao', function ($consultaMf) {
                if($consultaMf->proposicao->sn_possui_revisora)
                    return '<a origem="'.$consultaMf->proposicao->origem.'" href="'.route('parla::proposicoes.show',['id'=>$consultaMf->proposicao->id_proposicao]).'">'.$consultaMf->proposicao->origem.' - '.$consultaMf->proposicao->revisora.'</a>';
                else
                    return '<a origem="'.$consultaMf->proposicao->origem.'" href="'.route('parla::proposicoes.show',['id'=>$consultaMf->proposicao->id_proposicao]).'">'.$consultaMf->proposicao->origem.'</a>';
            })
            ->addColumn('sg_orgao', function ($consultaMf) {
                return $consultaMf->orgao->sg_orgao;
            })
            ->addColumn('dt_envio', function ($consultaMf) {
                return $consultaMf->dt_envio;
            })
            ->addColumn('tx_tipo_consulta', function ($consultaMf) {
                return $consultaMf->tipoConsulta->tx_tipo_consulta;
            })
            ->addColumn('no_comissao', function ($consultaMf) {
                return $consultaMf->no_comissao;
            })
            ->addColumn('nr_prioritario', function ($consultaMf) {
                return $consultaMf->nr_prioritario;
            })
            ->addColumn('dt_retorno', function ($consultaMf) {
                return $consultaMf->dt_retorno;
            })
            ->addColumn('tx_tipo_posicao', function ($consultaMf) {
                if($consultaMf->id_tipo_posicao)
                    return $consultaMf->tipoPosicao->tx_tipo_posicao;
            })
            ->addColumn('status', function ($consultaMf) {
                if($consultaMf->status == 'C')
                    return '<span class="label label-success">Concluído</span>';
                elseif($consultaMf->status == 'P')
                    return '<span class="label label-info">Pendente</span>';
                elseif($consultaMf->status == 'A')
                    return '<span class="label label-danger">Atrasado</span> ';
            })

            ->addColumn('acoes', function ($consultaMf) use ($canEdit, $canDestroy) {
                $retornoEdit = "";
                $retornoDestroy = "";

                if($canEdit) {
                    $retornoEdit = '<a href="#" data-url="'.route('parla::consultasMf.edit',['id'=>$consultaMf->id_consulta_mf]).'" class="btn btn-xs btn-info update" data-rel="tooltip" data-original-title="Editar"><i class="ace-icon fa fa-pencil"></i></a>';
                }

                if($canDestroy) {
                    $retornoDestroy = '<a href="#" data-id="'.$consultaMf->id_consulta_mf.'" class="btn btn-xs btn-danger delete" data-url="'.route('parla::consultasMf.destroy',['id'=>$consultaMf->id_consulta_mf]).'" data-rel="tooltip" data-original-title="Excluir"><i class="ace-icon fa fa-trash-o"></i></a>';
                }
                
                return $retornoEdit.' '.$retornoDestroy;
            })
            ->rawColumns(['proposicao','status','acoes'])
            ->make(true);
    }

    /**
     * Show the form for creating a new ConsultaMf.
     *
     */
    public function create($id_proposicao = null)
    {   
        $mode = "create";
        $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
        $listaComissoes = $this->comissaoRepository->preparaListaComissoes();
        $listaTiposConsulta = $this->tipoConsultaRepository->preparaListaTiposConsulta();
        $listaTiposPosicao = $this->tipoPosicaoRepository->listsOpcional('tx_tipo_posicao','id_tipo_posicao');

        $html = view('parla::consultas_mf._modal', compact('id_proposicao','mode','listaProposicoes','listaOrgaos','listaComissoes','listaTiposConsulta','listaTiposPosicao'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Store a newly created ConsultaMf in storage.
     *
     * @param CreateConsultaMfRequest $request
     *
     */
    public function store(ConsultaMfRequest $request, $id_proposicao = null)
    {
        $this->consultaMfRepository->create($request->all());

        $html = $this->renderizarTabela($id_proposicao);
        
        return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]); 

    }

    /**
     * Show the form for editing the specified ConsultaMf.
     *
     * @param  int $id
     *
     */
    public function edit($id, $id_proposicao = null)
    {
        $mode = "update";
        $consultaMf = $this->consultaMfRepository->find($id);
        $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
        $listaComissoes = $this->comissaoRepository->preparaListaComissoes();
        $listaTiposConsulta = $this->tipoConsultaRepository->preparaListaTiposConsulta();
        $listaTiposPosicao = $this->tipoPosicaoRepository->preparaListaTiposPosicao();

        $html = view('parla::consultas_mf._modal', compact('id_proposicao','consultaMf','listaProposicoes','listaOrgaos','listaComissoes','mode','listaTiposConsulta','listaTiposPosicao'))->render();
        return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Update the specified ConsultaMf in storage.
     *
     * @param  int              $id
     * @param UpdateConsultaMfRequest $request
     *
     * @return Response
     */
    public function update($id, ConsultaMfRequest $request, $id_proposicao = null)
    {
        
        $consultaMf = $this->consultaMfRepository->find($id)->update($request->all());

        $html = $this->renderizarTabela($id_proposicao);

        return response(['msg' =>trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);
    }


    /**
     * Remove the specified ConsultaMf from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, $id_proposicao = null)
    {
        try{

            $this->consultaMfRepository->find($id)->delete();
            $html = $this->renderizarTabela($id_proposicao);
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }

    /**
     * Show the form for creating a new Relatorio de ConsultaMf.
     *
     */
    public function relatorio() {   
        return view('parla::consultas_mf.relatorios.index'); 
    }

    /**
     * Gera Relatorio de ConsultaMf.
     *
     */
    public function geraRelatorio(Request $request) {

        $dtInicio = $request->dt_inicio;
        $dtFim = $request->dt_fim;
        $sgCasaTramitacao = $request->sg_casa_tramitacao;
        if($request->in_tipo_relatorio == 1) { //Relatório quantitativo de consultas a órgãos
            $tipo = 1;

            $dados = $this->consultaMfRepository->preparaDadosRelatorioTipo1($request->all());

            $orgaoLabels = array();
            $orgaoValues = array();

            foreach ($dados as $orgao => $dado) {
                $consultas[$orgao] = Charts::create('pie', 'highcharts')
                    ->colors(['#4CAF50','#03A9F4','#F44336'])
                    ->title("Consultas ".$orgao)
                    ->labels(['Concluídas', 'Pendentes','Atrasadas'])
                    ->height(280)
                    ->values([$dados[$orgao]["C"],$dados[$orgao]["P"],$dados[$orgao]["A"]]); 

                if($orgao != "MF") {
                    array_push($orgaoLabels,$orgao);   
                    array_push($orgaoValues, $dados[$orgao]["C"]+$dados[$orgao]["P"]+$dados[$orgao]["A"]);   
                }
            }

            $orgaosConsultados = Charts::create('pie', 'highcharts')
                ->template("google-design-material")
                ->title("Órgãos consultados")
                ->labels($orgaoLabels)
                ->height(300)
                ->values($orgaoValues);

            $pdfFile = '/uploads/parla/relatorios/pdf/'.date("YmdHis").'_parla_relatorio_quantitativo_de_consultas_a_orgaos.pdf';
            PDF::loadView('parla::consultas_mf.relatorios._tipo1_pdf',compact('dtInicio','dtFim','sgCasaTramitacao','dados','orgaosConsultados'))->save(public_path().$pdfFile);

            $xlsPath = '/uploads/parla/relatorios/xls/';
            $xlsFilename = date("YmdHis").'_parla_relatorio_quantitativo_de_consultas_a_orgaos';
            $xlsFile = $xlsPath.$xlsFilename.'.xls';

            $dadosXls = array(['Órgão','Concluídas','Pendentes','Atrasadas','Total']);
            foreach ($dados as $orgao => $dado) {
                if($orgao != "MF") {
                    array_push($dadosXls, [$orgao,$dados[$orgao]["C"],$dados[$orgao]["P"],$dados[$orgao]["A"],$dados[$orgao]["C"]+$dados[$orgao]["P"]+$dados[$orgao]["A"]]);
                }
            }

            Excel::create($xlsFilename, function($excel) use($dadosXls, $dtInicio, $dtFim) {
                $excel->sheet('Consultas MF', function($sheet) use($dadosXls, $dtInicio, $dtFim) {
                    $sheet->cells('A1:E1', function($cells) {
                        $cells->setBackground('#dddddd');
                        $cells->setFontWeight('bold');
                        $cells->setAlignment('center');
                    });
                    $sheet->fromArray($dadosXls,null,'A1',true,false);
                });
            })->store('xls', public_path().$xlsPath);

            $html =  view('parla::consultas_mf.relatorios.relatorio', compact('tipo','dtInicio','dtFim','sgCasaTramitacao','dados','consultas','orgaosConsultados','pdfFile','xlsFile'))->render();  
            return response(['msg' => 'Relatório criado', 'status' => 'success', 'html'=> $html]);
        }
        else if($request->in_tipo_relatorio == 2) { //Relatório analítico de consulta por órgão
            $tipo = 2;

            $dados = $this->consultaMfRepository->preparaDadosRelatorioTipo2($request->all());

            foreach ($dados as $orgao => $dado) {
                $consultas[$orgao] = Charts::create('pie', 'highcharts')
                    ->colors(['#4CAF50','#03A9F4','#F44336'])
                    ->title("Consultas ".$orgao)
                    ->labels(['Concluídas', 'Pendentes','Atrasadas'])
                    ->height(300)
                    ->values([sizeof($dados[$orgao]["C"]),sizeof($dados[$orgao]["P"]),sizeof($dados[$orgao]["A"])]); 
            }

            $pdfFile = '/uploads/parla/relatorios/pdf/'.date("YmdHis").'_parla_relatorio_analitico_de_consultas_por_orgao.pdf';
            PDF::loadView('parla::consultas_mf.relatorios._tipo2_pdf',compact('dtInicio','dtFim','sgCasaTramitacao','dados'))->setPaper('A4', 'landscape')->save(public_path().$pdfFile);

            $xlsPath = '/uploads/parla/relatorios/xls/';
            $xlsFilename = date("YmdHis").'_parla_relatorio_analitico_de_consultas_por_orgao';
            $xlsFile = $xlsPath.$xlsFilename.'.xls';

            $dadosXls = array(['Órgão','Proposição','Ementa','Envio','Retorno','Status']);
            foreach ($dados["MF"]["A"] as $consulta) {
                array_push($dadosXls, [$consulta->orgao->sg_orgao, $consulta->proposicao->sn_possui_revisora ? $consulta->proposicao->origem.' - '.$consulta->proposicao->revisora : $consulta->proposicao->origem, $consulta->proposicao->tx_ementa, $consulta->dt_envio, $consulta->dt_retorno, 'Atrasada']);
            }

            foreach ($dados["MF"]["P"] as $consulta) {
                array_push($dadosXls, [$consulta->orgao->sg_orgao, $consulta->proposicao->sn_possui_revisora ? $consulta->proposicao->origem.' - '.$consulta->proposicao->revisora : $consulta->proposicao->origem, $consulta->proposicao->tx_ementa, $consulta->dt_envio, $consulta->dt_retorno, 'Pendente']);
            }

            foreach ($dados["MF"]["C"] as $consulta) {
                array_push($dadosXls, [$consulta->orgao->sg_orgao, $consulta->proposicao->sn_possui_revisora ? $consulta->proposicao->origem.' - '.$consulta->proposicao->revisora : $consulta->proposicao->origem, $consulta->proposicao->tx_ementa, $consulta->dt_envio, $consulta->dt_retorno, 'Concluída']);
            }

            Excel::create($xlsFilename, function($excel) use($dadosXls, $dtInicio, $dtFim) {
                $excel->sheet('Consultas MF', function($sheet) use($dadosXls, $dtInicio, $dtFim) {
                    $sheet->cells('A1:F1', function($cells) {
                        $cells->setBackground('#dddddd');
                        $cells->setFontWeight('bold');
                        $cells->setAlignment('center');
                    });
                    $sheet->fromArray($dadosXls,null,'A1',true,false);
                });
            })->store('xls', public_path().$xlsPath);

            $html =  view('parla::consultas_mf.relatorios.relatorio', compact('tipo','dtInicio','dtFim','sgCasaTramitacao','dados','consultas','pdfFile','xlsFile'))->render();  
            return response(['msg' =>'Relatório criado','status' => 'success', 'html'=> $html]);
        }
        else if($request->in_tipo_relatorio == 3) {
            $tipo = 3;

            $dados = $this->consultaMfRepository->preparaDadosRelatorioTipo3($request->all());

            $pdfFile = '/uploads/parla/relatorios/pdf/'.date("YmdHis").'_parla_relatorio_por_proposicao_legislativa.pdf';
            PDF::loadView('parla::consultas_mf.relatorios._tipo3_pdf',compact('dtInicio','dtFim','sgCasaTramitacao','dados'))->setPaper('A4', 'landscape')->save(public_path().$pdfFile);

            $xlsPath = '/uploads/parla/relatorios/xls/';
            $xlsFilename = date("YmdHis").'_parla_relatorio_por_proposicao_legislativa';
            $xlsFile = $xlsPath.$xlsFilename.'.xls';

            $dadosXls = array(['Proposição','Ementa','Órgãos consultados']);
            foreach ($dados as $proposicao) {
                array_push($dadosXls, [$proposicao['Proposição'], $proposicao['Ementa'], $proposicao['Órgãos']]);
            }

            Excel::create($xlsFilename, function($excel) use($dadosXls, $dtInicio, $dtFim) {
                $excel->sheet('Consultas MF', function($sheet) use($dadosXls, $dtInicio, $dtFim) {
                    $sheet->cells('A1:C1', function($cells) {
                        $cells->setBackground('#dddddd');
                        $cells->setFontWeight('bold');
                        $cells->setAlignment('center');
                    });
                    $sheet->fromArray($dadosXls,null,'A1',true,false);
                });
            })->store('xls', public_path().$xlsPath);

            $html =  view('parla::consultas_mf.relatorios.relatorio', compact('tipo','dtInicio','dtFim','sgCasaTramitacao','dados','pdfFile','xlsFile'))->render();  
            return response(['msg' =>'Relatório criado','status' => 'success', 'html'=> $html]);
        }
    }

    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela($id_proposicao = null)
    {
        //recuperando os sistemas para renderizar a tabela
        if($id_proposicao == null) {
            $consultasMf = $this->consultaMfRepository->all();
            return view('parla::consultas_mf._tabela', compact('consultasMf'))->render(); 
        }
        else {
            $mode = "";
            $proposicao = $this->proposicaoRepository->find($id_proposicao);
            $id_proposicao = $proposicao->id_proposicao;
            $listaProposicoes = $this->proposicaoRepository->preparaListaProposicoes();
            $listaOrgaos = $this->orgaoRepository->prepareListaChosenAll(self::SISTEMA);
            $listaComissoes = $this->comissaoRepository->preparaListaComissoes();
            $listaTiposConsulta = $this->tipoConsultaRepository->preparaListaTiposConsulta();
            $listaTiposPosicao = $this->tipoPosicaoRepository->preparaListaTiposPosicao();
            return view('parla::consultas_mf._tabela', compact('id_proposicao','proposicao','mode','listaProposicoes','listaOrgaos','listaComissoes','listaTiposConsulta','listaTiposPosicao'))->render();
        }
    }
}
