<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Repositories\RelatorioContratoRepository;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RelatorioContratoGeralController extends RelatorioContratoController
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
     * Método responsável por receber informações do Filtro de Pesquisa e listar o resultado dos Contratos em Geral
     *
     * @param Request $request
     *
     */
    public function processa_relatorio(Request $request)
    {
        $contratos = $this->relatorioContratoRepository->findContratoRelatorio($request);

        $arquivoXLS = $this->gera_excel_contrato($contratos);

        $html = view('gescon::relatorios._tabela_resultado_pesquisa', compact('contratos', 'arquivoXLS'))->render(); 
        
        return response(['msg' => 'Consulta Realizada', 'status' => 'success', 'html'=> $html]);  
    }

    /**
    * Método responsável por gerar o arquivo Excel dos Contratos em Geral de acordo com os parâmetros informados
    * 
    * @param $parametros
    *
    * @return Contrato
    */ 
    public function gera_excel_contrato($contratos)
    {
        $array_contrato = $this->__preparaDadosXlsContrato($contratos);

        return $this->__createXlsContrato($array_contrato);

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

                $qtd_max = max([count($dado->processosPagamento), count($dado->fiscais)]);

                parent::_preparaArrayDadosBasicosContrato($array_contrato, $dado, $indice, $qtd_max);
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
     * Método responsável por gerar o arquivo XLS Geral dos Contratos, de acordo com o tipo de objeto
     *
     * @param Request $dados
     */
    private function __createXlsContrato($array_contrato)
    {
        $caminho_disk = Storage::disk('public_GESCON')->getDriver()->getAdapter()->getPathPrefix();
        $xlsPath = $caminho_disk . "arquivos_relatorios/xls/";
        $xlsFilename = date("YmdHis").'_gescon_relatorio_contrato_geral';
        $xlsFile = $xlsPath.$xlsFilename.'.xls';
        
        array_unshift($array_contrato, ['NR_CONTRATO','UASG','NO_CONTRATANTE','UF','NO_REPRESENTANTE','TP_CONTRATO', 
            'NR_MODALIDADE', 'NO_MODALIDADE', 'NR_PROCESSO', 'NR_CRONOGRAMA', 'NR_CPF_CNPJ', 'NO_RAZAO_SOCIAL', 
            'DS_OBJETO', 'VL_MENSAL', 'VL_ANUAL', 'VL_GLOBAL',
            'DT_ASSINATURA', 'DT_PUBLICACAO', 'DT_INICIO_SERVICO', 'DT_CESSACAO', 'DT_PRORROGACAO', 
            'NR_NOTA_EMPENHO', 'TP_EMPENHO', 'NR_PLANO_INTERNO', 'NR_ELEMENTO_DESPESA', 
            'MODALIDADE_GARANTIA', 'VL_GARANTIA', 'OP_PERCENTAGEM_GARANTIA', 'DT_VENCIMENTO_GARANTIA', 
            'TP_FISCAL', 'NO_FISCAL_TITULAR', 'NO_FISCAL_SUBSTITUTO']);

        
        Excel::create($xlsFilename, function($excel) use($array_contrato) {
            $excel->sheet('Contratos_MF', function($sheet) use($array_contrato) {
                $sheet->cells('A1:AF1', function($cells) {
                    $cells->setBackground('#dddddd');
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->fromArray($array_contrato,null,'A1',true,false);
            });
        })->store('xls', $xlsPath);

        $arquivo = explode('public', $xlsFile);
        return $arquivo[1];
    }

}
