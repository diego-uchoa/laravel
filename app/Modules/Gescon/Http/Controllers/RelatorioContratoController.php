<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Repositories\ContratoRepository;
use App\Modules\Gescon\Repositories\ContratanteRepository;
use App\Modules\Gescon\Repositories\ContratadaRepository;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Modules\Gescon\Repositories\EdificioRepository;
use App\Modules\Gescon\Repositories\FiscalRepository;
use App\Modules\Gescon\Repositories\RelatorioContratoRepository;
use App\Modules\Gescon\Enum\ObjetoContrato;
use App\Modules\Gescon\Enum\StatusContrato;
use App\Modules\Gescon\Http\Requests\RelatorioComparativoRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;
use MaskHelper;
use GesconHelper;

class RelatorioContratoController extends Controller
{
    const noSistema = "GESCON";
    protected $contratoRepository;
    protected $contratanteRepository;
    protected $contratadaRepository;
    protected $orgaoRepository;
    protected $edificioRepository;
    protected $fiscalRepository;
    protected $relatorioContratoRepository;

    public function __construct(ContratoRepository $contratoRepository, 
                                    ContratanteRepository $contratanteRepository, ContratadaRepository $contratadaRepository,
                                    OrgaoRepository $orgaoRepository, EdificioRepository $edificioRepository,
                                    FiscalRepository $fiscalRepository, RelatorioContratoRepository $relatorioContratoRepository)
    {
        $this->contratoRepository = $contratoRepository;
        $this->contratanteRepository = $contratanteRepository;
        $this->contratadaRepository = $contratadaRepository;
        $this->orgaoRepository = $orgaoRepository;
        $this->edificioRepository = $edificioRepository;
        $this->fiscalRepository = $fiscalRepository;
        $this->relatorioContratoRepository = $relatorioContratoRepository;
    }

    /**
     * Método responsável por exibir a tela de filtro de Pesquisa de Contrataos em Geral
     *
     */
    public function index_geral_contrato()
    {
        $listaObjetoContrato = ObjetoContrato::getConstants();
        $listaContratante = $this->contratanteRepository->orgaosList();
        $listaContratada = $this->contratadaRepository->lists('no_razao_social', 'id_contratada');
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenBySiglaNome('', self::noSistema);
        $listaEdificios = $this->edificioRepository->lists('no_edificio', 'id_edificio');
        $listaFiscais = $this->fiscalRepository->lists('no_fiscal', 'id_fiscal');
        $listaStatusContrato = StatusContrato::getConstants();
        $url_rota = 'gescon::relatorios.processa_geral';
        $titulo_Pesquisa = 'Contratos em Geral';

        return view('gescon::relatorios.pesquisa_contrato', compact('listaObjetoContrato', 'listaContratante', 'listaContratada', 'listaOrgaos', 'listaEdificios', 'listaFiscais', 'listaStatusContrato', 'url_rota', 'titulo_Pesquisa'));
    }
    
    /**
     * Método responsável por exibir a tela de filtro de Pesquisa de Contrataos para o Comparativo
     *
     */
    public function index_comparativo_contrato()
    {
        $listaObjetoContrato = ObjetoContrato::getConstants();
        $listaContratante = $this->contratanteRepository->orgaosList();
        $listaContratada = $this->contratadaRepository->lists('no_razao_social', 'id_contratada');
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenBySiglaNome('', self::noSistema);
        $listaEdificios = $this->edificioRepository->lists('no_edificio', 'id_edificio');
        $listaFiscais = $this->fiscalRepository->lists('no_fiscal', 'id_fiscal');
        $listaStatusContrato = StatusContrato::getConstants();
        $url_rota = 'gescon::relatorios.processa_comparativo';
        $titulo_Pesquisa = 'Comparativo de Contratos';

        return view('gescon::relatorios.pesquisa_contrato', compact('listaObjetoContrato', 'listaContratante', 'listaContratada', 'listaOrgaos', 'listaEdificios', 'listaFiscais', 'listaStatusContrato', 'url_rota', 'titulo_Pesquisa'));
    }

    /**
     * Método responsável por criar o Array dos dados básicos do Contrato
     *
     * @param Array $array (por referência)
     * @param Contrato $dado
     * @param Integer $indice
     * @param Integer $qtd
     */
    protected function _preparaArrayDadosBasicosContrato(&$array, $dado, $indice, $qtd)
    {
        for ( $i=0; $i<$qtd; $i++ ) {
            if ( $i == 0 ) {
                $array[$indice] = ['nr_contrato' => $dado->nr_contrato, 'co_uasg' => $dado->co_uasg,
                                            'no_contratante' => $dado->contratante->orgao->no_orgao,
                                            'sg_uf' => $dado->contratante->orgao->municipio->uf->sg_uf,
                                            'no_representante' => $dado->contratante->representante->no_representante,
                                            'tp_contrato' => $dado->tipo_contrato,
                                            'nr_modalidade' => MaskHelper::aplicaMascara($dado->nr_modalidade, "####/####"),
                                            'no_modalidade' => $dado->modalidade->no_modalidade,
                                            'nr_processo' => MaskHelper::aplicaMascara($dado->nr_processo, "#####.######/####-##"),
                                            'nr_cronograma' => $dado->nr_cronograma,

                                            'nr_cpf_cnpj' => $dado->contratada->nr_cpf_cnpj,
                                            'no_razao_social' => $dado->contratada->no_razao_social,
                                            'ds_objeto' => $dado->ds_objeto,
                                            'vl_mensal' => $dado->vl_mensal,
                                            'vl_anual' => $dado->vl_anual,
                                            'vl_global' => $dado->vl_global];
            } else {
                $array[$indice + $i] = ['nr_contrato' => '', 'co_uasg' => '', 'no_contratante' => '', 'sg_uf' => '',
                                            'no_representante' => '', 'tp_contrato' => '', 'nr_modalidade' => '',
                                            'no_modalidade' => '', 'nr_processo' => '', 'nr_cronograma' => '',
                                            'nr_cpf_cnpj' => '', 'no_razao_social' => '', 'ds_objeto' => '',
                                            'vl_mensal' => '', 'vl_anual' => '', 'vl_global' => ''];
            }
        }
    }

    /**
     * Método responsável por criar o Array dos dados básicos do Contrato referente as Datas 
     *
     * @param Array $array (por referência)
     * @param Contrato $dado
     * @param Integer $indice
     * @param Integer $qtd
     */
    protected function _preparaArrayDadosBasicosContratoDatas(&$array, $dado, $indice, $qtd)
    {
        for ( $i=0; $i<$qtd; $i++ ) {
            if ( $i == 0 ) {
                $array[$indice] += ['dt_assinatura' => $dado->dt_assinatura,
                                            'dt_publicacao' => $dado->dt_publicacao,
                                            'dt_inicio_servico' => $dado->dt_inicio_servico,
                                            'dt_cessacao' => $dado->dt_cessacao,
                                            'dt_prorrogacao' => $dado->dt_prorrogacao];
            } else {
                $array[$indice + $i] += ['dt_assinatura' => '', 'dt_publicacao' => '', 'dt_inicio_servico' => '',
                                            'dt_cessacao' => '', 'dt_prorrogacao' => ''];
            }
        }
    }

    /**
     * Método responsável por popular o Array de Contratos com os Processos de Pagamentos
     *
     * @param Array $array (por referência)
     * @param Contrato $dado
     * @param Integer $indice
     * @param Integer $qtd
     */
    protected function _preparaArrayProcessoPagamento(&$array, $dado, $indice, $qtd)
    {
        $indice_pagamento = $indice;
        $qtd += $indice_pagamento;
        if (count($dado->processosPagamento) > 0) {
            foreach ($dado->processosPagamento as $processo) {
                $array[$indice_pagamento] += ['nr_nota_empenho' => $processo->nr_nota_empenho];    
                $array[$indice_pagamento] += ['tp_empenho' => $processo->tipoEmpenho()];    
                $array[$indice_pagamento] += ['nr_plano_interno' => $processo->nr_plano_interno];
                $array[$indice_pagamento] += ['nr_elemento_despesa' => $processo->nr_elemento_despesa];    
                $indice_pagamento += 1;
            }
        }
        for ( $k=$indice_pagamento; $k<$qtd; $k++ ) {
            $array[$k] += ['nr_nota_empenho' => ''];    
            $array[$k] += ['tp_empenho' => ''];    
            $array[$k] += ['nr_plano_interno' => ''];    
            $array[$k] += ['nr_elemento_despesa' => ''];    
        }
    }

    /**
     * Método responsável por criar o Array dos dados básicos do Contrato referente a Modalidade de Garantia
     *
     * @param Array $array (por referência)
     * @param Contrato $dado
     * @param Integer $indice
     * @param Integer $qtd
     */
    protected function _preparaArrayDadosBasicosContratoModalidadeGarantia(&$array, $dado, $indice, $qtd)
    {
        for ( $i=0; $i<$qtd; $i++ ) {
            if ( $i == 0 ) {
                $array[$indice] += ['modalidade_garantia' => $dado->modalidade_garantia,
                                        'vl_garantia' => $dado->vl_garantia,
                                        'op_percentual_garantia' => $dado->op_percentual_garantia,
                                        'dt_vencimento_garantia' => $dado->dt_vencimento_garantia];
            } else {
                $array[$indice + $i] += ['modalidade_garantia' => '', 'vl_garantia' => '', 'op_percentual_garantia' => '',
                                            'dt_vencimento_garantia' => ''];
            }
        }
    }

    /**
     * Método responsável por popular o Array de Contratos com os Fiscais
     *
     * @param Array $array (por referência)
     * @param Contrato $dado
     * @param Integer $indice
     * @param Integer $qtd
     */
    protected function _preparaArrayFiscais(&$array, $dado, $indice, $qtd)
    {
        $indice_fiscal = $indice;
        $qtd += $indice_fiscal;
        if (count($dado->fiscais) > 0) {
            foreach ($dado->fiscais as $fiscal) {
                $array[$indice_fiscal] += ['tp_fiscal' => $fiscal->tipoFiscal()];    
                $array[$indice_fiscal] += ['no_fiscal_titular' => $fiscal->fiscalTitular->no_fiscal];    
                $array[$indice_fiscal] += ['no_fiscal_substituto' => isset($fiscal->id_fiscal_substituto) ? $fiscal->fiscalSubstituto->no_fiscal : ' - '];
                $indice_fiscal += 1;
            }
        }
        for ( $l=$indice_fiscal; $l<$qtd; $l++ ) {
            $array[$l] += ['tp_fiscal' => ''];    
            $array[$l] += ['no_fiscal_titular' => ''];    
            $array[$l] += ['no_fiscal_substituto' => ''];    
        }
    }
}
