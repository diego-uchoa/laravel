<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Repositories\RelatorioContratoRepository;
use App\Modules\Gescon\Http\Requests\RelatorioComparativoRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use GesconHelper;

class RelatorioContratoComparativoController extends RelatorioContratoController
{
    const noSistema = "GESCON";
    protected $relatorioContratoRepository;
    
    /**
     * Método Contrutor
     *
     */
    public function __construct(RelatorioContratoRepository $relatorioContratoRepository)
    {
        $this->relatorioContratoRepository = $relatorioContratoRepository;
    }

    /**
     * Método responsável por receber informações do Filtro de Pesquisa e listar o resultado dos Contratos para Compará-los
     *
     * @param Request $request
     *
     */
    public function processa_relatorio(RelatorioComparativoRequest $request)
    {
        $contratos = $this->relatorioContratoRepository->findContratoRelatorio($request);

        $arquivoXLS = $this->gera_excel_contrato($request['tp_contrato'], $contratos);

        $html = view('gescon::relatorios._tabela_resultado_pesquisa', compact('contratos', 'arquivoXLS'))->render(); 
        
        return response(['msg' => 'Consulta Realizada', 'status' => 'success', 'html'=> $html]);  
    }


    /**
    * Método responsável por gerar o arquivo Excel dos Contratos para Compará-los de acordo com os parâmetros informados
    * 
    * @param $parametros
    *
    * @return Contrato
    */ 
    public function gera_excel_contrato($tp_contrato, $contratos)
    {
        $array_contrato = $this->__preparaDadosXlsContrato($contratos);

        return $this->__createXlsContrato($tp_contrato, $array_contrato);

    }   

    /**
     * Método responsável por preparar os dados do Contrato para geração do XLS
     *
     * @param Request $dados
     */
    private function __preparaDadosXlsContrato($dados)
    {
        $indice = 0;
        $array_contrato = [];

        if (count($dados)){

            foreach ($dados as $dado) {

                $qtd_max = max([count($dado->itensContratacao), count($dado->processosPagamento), count($dado->fiscais)]);

                parent::_preparaArrayDadosBasicosContrato($array_contrato, $dado, $indice, $qtd_max);
                $this->_preparaArrayItensContratacao($array_contrato, $dado, $indice, $qtd_max, $dado->in_objeto);
                parent::_preparaArrayDadosBasicosContratoDatas($array_contrato, $dado, $indice, $qtd_max);
                parent::_preparaArrayProcessoPagamento($array_contrato, $dado, $indice, $qtd_max);
                parent::_preparaArrayDadosBasicosContratoModalidadeGarantia($array_contrato, $dado, $indice, $qtd_max);
                parent::_preparaArrayFiscais($array_contrato, $dado, $indice, $qtd_max);

                $indice += $qtd_max;

            }

        }

        return $array_contrato;
    }


    /**
     * Método responsável por gerar o arquivo XLS Comparativo dos Contratos, de acordo com o tipo de objeto
     *
     * @param Request $dados
     */
    private function __createXlsContrato($tipo, $array_contrato)
    {
        $caminho_disk = Storage::disk('public_GESCON')->getDriver()->getAdapter()->getPathPrefix();
        $xlsPath = $caminho_disk . "arquivos_relatorios/xls/";
        $xlsFilename = date("YmdHis").'_gescon_relatorio_contrato_comparativo';
        $xlsFile = $xlsPath.$xlsFilename.'.xls';
        
        switch ($tipo) {
            case ("TR" || "VG" || "BG" || "LP"):
                
                array_unshift($array_contrato, ['NR_CONTRATO','UASG','NO_CONTRATANTE','UF','NO_REPRESENTANTE','TP_CONTRATO', 'NR_MODALIDADE', 'NO_MODALIDADE', 'NR_PROCESSO', 'NR_CRONOGRAMA', 'NR_CPF_CNPJ', 'NO_RAZAO_SOCIAL', 'DS_OBJETO', 'VL_MENSAL', 'VL_ANUAL', 'VL_GLOBAL', 'UNIDADE_ATENDIDA', 'EDIFICIO', 'TP_ITEM', 'QT_ITEM', 'UN_ITEM', 'VL_ITEM', 'VL_TOTAL', 
                    'DT_ASSINATURA', 'DT_PUBLICACAO', 'DT_INICIO_SERVICO', 'DT_CESSACAO', 'DT_PRORROGACAO', 
                    'NR_NOTA_EMPENHO', 'TP_EMPENHO', 'NR_PLANO_INTERNO', 'NR_ELEMENTO_DESPESA', 
                    'MODALIDADE_GARANTIA', 'VL_GARANTIA', 'OP_PERCENTAGEM_GARANTIA', 'DT_VENCIMENTO_GARANTIA', 
                    'TP_FISCAL', 'NO_FISCAL_TITULAR', 'NO_FISCAL_SUBSTITUTO']);

                
                Excel::create($xlsFilename, function($excel) use($array_contrato) {
                    $excel->sheet('Contratos_MF', function($sheet) use($array_contrato) {
                        $sheet->cells('A1:AM1', function($cells) {
                            $cells->setBackground('#dddddd');
                            $cells->setFontWeight('bold');
                            $cells->setAlignment('center');
                        });
                        $sheet->fromArray($array_contrato,null,'A1',true,false);
                    });
                })->store('xls', $xlsPath);
                break;

        }

        $arquivo = explode('public', $xlsFile);
        return $arquivo[1];
    }

    /**
     * Método responsável por popular o Array de Contratos com os Itens de Contratação
     *
     * @param Array $array (por referência)
     * @param Contrato $dado
     * @param Integer $indice
     * @param Integer $qtd
     * @param Char $tipo
     */
    protected function _preparaArrayItensContratacao(&$array, $dado, $indice, $qtd, $tipo)
    {
        switch ($tipo) {
            case ("TR" || "VG" || "BG" || "LP"):
                $this->_preparaArrayItensContratacaoTerceirizacao($array, $dado, $indice, $qtd);
                break;
        }
    }

    /**
     * Método responsável por popular o Array de Contratos com os Itens de Contratação do Tipo de Terceirização
     *
     * @param Array $array (por referência)
     * @param Contrato $dado
     * @param Integer $indice
     * @param Integer $qtd
     */
    protected function _preparaArrayItensContratacaoTerceirizacao(&$array, $dado, $indice, $qtd)
    {
        $indice_item = $indice;
        $qtd += $indice_item;
        if (count($dado->itensContratacao) > 0) {
            foreach ($dado->itensContratacao as $item) {
                $array[$indice_item] += ['sg_orgao' => $item->orgao->sg_orgao];    
                $array[$indice_item] += ['no_edificio' => $item->edificio->no_edificio];    
                $array[$indice_item] += ['tp_item' => $item->tipoItemContratacao->ds_tipo_item_contratacao];    
                $array[$indice_item] += ['qt_item' => $item->qt_item_contratacao];    
                $array[$indice_item] += ['un_item' => $item->unidadeMedidaItemContratacao->sg_unidade_medida_item_contratacao];    
                $array[$indice_item] += ['vl_item' => GesconHelper::maskMoney($item->vl_item_contratacao)];    
                $array[$indice_item] += ['vl_total' => GesconHelper::maskMoney($item->vl_item_contratacao * $item->qt_item_contratacao)];
                $indice_item += 1;
            }
        }
        for ( $j=$indice_item; $j<$qtd; $j++ ) {
            $array[$j] += ['sg_orgao' => ''];    
            $array[$j] += ['no_edificio' => ''];    
            $array[$j] += ['tp_item' => ''];    
            $array[$j] += ['qt_item' => ''];    
            $array[$j] += ['un_item' => ''];    
            $array[$j] += ['vl_item' => ''];    
            $array[$j] += ['vl_total' => ''];
        }
    }
}
