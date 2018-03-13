<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Modules\Gescon\Repositories\EdificioRepository;
use App\Modules\Gescon\Repositories\TipoItemContratacaoRepository;
use App\Modules\Gescon\Repositories\UnidadeMedidaItemContratacaoRepository;
use App\Modules\Gescon\Http\Requests\ContratoRequest;
use App\Modules\Gescon\Services\ContratoTerceirizacaoService;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Exception;

class ContratoTerceirizacaoController extends ContratoController
{
    const noSistema = "GESCON";
    private $contratoTerceirizacaoService;
    private $orgaoRepository;
    private $edificioRepository;
    private $tipoItemContratacaoRepository;
    private $unidadeMedidaItemContratacaoRepository;
    
    public function __construct(ContratoTerceirizacaoService $contratoTerceirizacaoService,
                                    OrgaoRepository $orgaoRepository,
                                    EdificioRepository $edificioRepository,
                                    TipoItemContratacaoRepository $tipoItemContratacaoRepository,
                                    UnidadeMedidaItemContratacaoRepository $unidadeMedidaItemContratacaoRepository)
    {
        $this->contratoTerceirizacaoService = $contratoTerceirizacaoService;
        $this->orgaoRepository = $orgaoRepository;
        $this->edificioRepository = $edificioRepository;
        $this->tipoItemContratacaoRepository = $tipoItemContratacaoRepository;
        $this->unidadeMedidaItemContratacaoRepository = $unidadeMedidaItemContratacaoRepository;
        parent::__construct();
    }

    /**
     * Mostre o formulário para criar um novo Contrato do Tipo Terceirizacao.
     *
     */
    public function create($inObjeto)
    {   
        $mode = "create";
        $var_contrato = parent::create($inObjeto);

        $ds_objeto = $this->ds_objeto;
        $listaTipoContrato = $this->listaTipoContrato;
        $listaTipoVariacao = $this->listaTipoVariacao;
        $listaModalidadeGarantia = $this->listaModalidadeGarantia;
        $listaTipoFiscal = $this->listaTipoFiscal;
        $listaTipoEmpenho = $this->listaTipoEmpenho;
        $listaTipoContratada = $this->listaTipoContratada;
        $listaModalidade = $this->listaModalidade;
        $listaIndiceVariacao = $this->listaIndiceVariacao;
        $listaUF = $this->listaUF;
        $listaMunicipio = $this->listaMunicipio;
        $listaOrgaos = $this->orgaoRepository->prepareListaChosenBySiglaNome('', self::noSistema);
        $listUfEdificio = $this->ufRepository->lists('sg_uf','sg_uf')->prepend('Selecione ...', null);
        $listEdificiosByUf = ['text' => '', 'id' => null];
        $listaUasg = $this->listaUasg;
        $listaAssinante = $this->listaAssinante;

        //Carregando dados espcíficos do Contrato de Terceirizacao já cadastrado
        $listaTipoItemContratacao = $this->tipoItemContratacaoRepository->prepareListaChosenByNome($inObjeto);
        $listaUnidadeMedida = $this->unidadeMedidaItemContratacaoRepository->listsByAttribute('sg_unidade_medida_item_contratacao','id_unidade_medida_item_contratacao','in_objeto',$inObjeto);
                
        return view('gescon::contratos.terceirizacao.create', compact('mode', 'inObjeto', 'listaUasg', 'ds_objeto', 'listaTipoContrato', 'listaTipoVariacao', 
                                                                        'listaModalidadeGarantia', 'listaTipoFiscal', 'listaTipoEmpenho', 'listaTipoContratada', 
                                                                        'listaModalidade', 'listaIndiceVariacao', 'listaUF', 'listaMunicipio', 'listaOrgaos', 
                                                                        'listaTipoItemContratacao', 'listUfEdificio', 'listaUnidadeMedida', 'listaAssinante'));
    }

    /**
     * Método responsável por inserir dados padrões do Contrato
     *
     */
    public function store(Request $request)
    {   
        try{

            $this->contratoTerceirizacaoService->storeContrato($request->all());
            return response(['msg' => 'Contrato cadastrado com sucesso!', 'status' => 'success', 'redirect_url' => route('gescon::contratos.index')]);

        }catch (Exception $e){
            
            return response(['msg' => 'Não foi possível realizar o cadastro do contrato.', 'detail' => $e->getMessage(), 'status' => 'error']);

        }

    }

    /**
     * Responsável por recuperar dados do Contrato do Tipo Terceirizacao para Edição
     *
     * @param Integer $id
     */
    public function edit($id)
    {
        try{
                    
            $mode = "";
            
            //Carregando dados básicos do Contrato já cadastrado
            parent::edit($id);
            $contrato = $this->contrato;
            $contratada  = $this->contrato->contratada;
            $listaUasg = $this->listaUasg;
            $inObjeto = $this->contrato->in_objeto;
            $ds_objeto = $this->ds_objeto;
            $listaTipoContrato = $this->listaTipoContrato;
            $listaTipoVariacao = $this->listaTipoVariacao;
            $listaModalidadeGarantia = $this->listaModalidadeGarantia;
            $listaTipoFiscal = $this->listaTipoFiscal;
            $listaTipoEmpenho = $this->listaTipoEmpenho;
            $listaModalidade = $this->listaModalidade;
            $listaIndiceVariacao = $this->listaIndiceVariacao;
            $listaTipoContratada = $this->listaTipoContratada;
            $listaUF = $this->listaUF;
            $listaMunicipio = $this->listaMunicipio;
            $listaOrgaos = $this->orgaoRepository->prepareListaChosenBySiglaNome('', self::noSistema);
            $listUfEdificio = $this->ufRepository->lists('sg_uf','sg_uf')->prepend('Selecione ...', null);
            $listEdificiosByUf = ['text' => '', 'id' => null];

            //Carregando dados espcíficos do Contrato de Terceirizacao já cadastrado
            $listaTipoItemContratacao = $this->tipoItemContratacaoRepository->prepareListaChosenByNome($this->in_objeto);
            $listaUnidadeMedida = $this->unidadeMedidaItemContratacaoRepository->listsByAttribute('sg_unidade_medida_item_contratacao','id_unidade_medida_item_contratacao','in_objeto',$inObjeto);
            
            return view('gescon::contratos.terceirizacao.edit', compact('mode', 'contrato', 'contratada', 'inObjeto', 'listaUasg', 'ds_objeto', 'listaTipoContrato', 'listaTipoVariacao', 
                                                                        'listaModalidadeGarantia', 'listaTipoFiscal', 'listaTipoEmpenho', 'listaModalidade', 
                                                                        'listaIndiceVariacao', 'listaTipoContratada', 'listaUF', 'listaMunicipio', 'listaEdificio', 
                                                                        'listaTipoItemContratacao', 'listaOrgaos', 'listEdificiosByUf', 'listUfEdificio', 'listaUnidadeMedida'));

        }catch(Exception $e){

            return redirect()->route('gescon::contratos.index')->with('exception', $e->getMessage());

        }
    }

    /**
     * Responsável por recuperar dados do Contrato do Tipo Terceirizacao para Visualização
     *
     * @param Integer $id
     */
    public function show($id)
    {
        try{
                    
            $mode = "";
            
            //Carregando dados básicos do Contrato já cadastrado
            parent::edit($id);
            $contrato = $this->contrato;
            $contratada  = $this->contrato->contratada;
            $listaUasg = $this->listaUasg;
            $inObjeto = $this->contrato->in_objeto;
            $ds_objeto = $this->ds_objeto;
            $listaTipoContrato = $this->listaTipoContrato;
            $listaTipoVariacao = $this->listaTipoVariacao;
            $listaModalidadeGarantia = $this->listaModalidadeGarantia;
            $listaTipoFiscal = $this->listaTipoFiscal;
            $listaTipoEmpenho = $this->listaTipoEmpenho;
            $listaModalidade = $this->listaModalidade;
            $listaIndiceVariacao = $this->listaIndiceVariacao;
            $listaTipoContratada = $this->listaTipoContratada;
            $listaUF = $this->listaUF;
            $listaMunicipio = $this->listaMunicipio;
            $listaOrgaos = $this->orgaoRepository->prepareListaChosenBySiglaNome('', self::noSistema);
            $listUfEdificio = $this->ufRepository->lists('sg_uf','sg_uf')->prepend('Selecione ...', null);
            $listEdificiosByUf = ['text' => '', 'id' => null];

            //Carregando dados espcíficos do Contrato de Terceirizacao já cadastrado
            $listaTipoItemContratacao = $this->tipoItemContratacaoRepository->prepareListaChosenByNome($this->in_objeto);
            $listaUnidadeMedida = $this->unidadeMedidaItemContratacaoRepository->listsByAttribute('sg_unidade_medida_item_contratacao','id_unidade_medida_item_contratacao','in_objeto',$inObjeto);
            
            return view('gescon::contratos.terceirizacao.show', compact('mode', 'contrato', 'contratada', 'inObjeto', 'listaUasg', 'ds_objeto', 'listaTipoContrato', 'listaTipoVariacao', 
                                                                        'listaModalidadeGarantia', 'listaTipoFiscal', 'listaTipoEmpenho', 'listaModalidade', 
                                                                        'listaIndiceVariacao', 'listaTipoContratada', 'listaUF', 'listaMunicipio', 'listaEdificio', 
                                                                        'listaTipoItemContratacao', 'listaOrgaos', 'listEdificiosByUf', 'listUfEdificio', 'listaUnidadeMedida'));

        }catch(Exception $e){

            return redirect()->route('gescon::contratos.index')->with('exception', $e->getMessage());

        }
    }

    public function update($id, ContratoRequest $request)
    {    
        try{

            $this->contratoTerceirizacaoService->updateContrato($request->all(), $id);
            return response(['msg' => 'Contrato atualizado com sucesso!', 'status' => 'success', 'redirect_url' => route('gescon::contratos.index')]);

        }catch (Exception $e){
            
            return response(['msg' => 'Não foi possível realizar a atualização do contrato.', 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }   


    
    /**
     * Excluir Itens de Contratação do Contrato
     *
     * @param  int $id_contrato_item_contratacao_terceirizacao
     *
     * @return Response
     */
    public function destroy_item_contratacao($id_contrato_item_contratacao_terceirizacao)
    {
        try{

            $this->contratoTerceirizacaoService->destroy_item_contratacao($id_contrato_item_contratacao_terceirizacao);
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success']);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

}
