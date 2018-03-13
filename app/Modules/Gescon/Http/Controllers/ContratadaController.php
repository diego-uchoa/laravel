<?php

namespace App\Modules\Gescon\Http\Controllers;

use App\Modules\Gescon\Http\Requests\ContratadaRequest;
use App\Modules\Gescon\Repositories\ContratadaRepository;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Gescon\Enum\TipoContratada;
use App\Repositories\UfRepository;
use App\Repositories\MunicipioRepository;
use App\Modules\Gescon\Services\ContratadaSiasgWsService;
use App\Helpers\UtilHelper;

class ContratadaController extends Controller
{
    /** @var  contratadaRepository */
    private $contratadaRepository;
    private $ufRepository;
    private $municipioRepository;
    private $contratadaSiasgWsService;

    public function __construct(ContratadaRepository $contratadaRepository, 
                                    UfRepository $ufRepository,
                                    MunicipioRepository $municipioRepository,
                                    ContratadaSiasgWsService $contratadaSiasgWsService)
    {
        $this->contratadaRepository = $contratadaRepository;
        $this->ufRepository = $ufRepository;
        $this->municipioRepository = $municipioRepository;
        $this->contratadaSiasgWsService = $contratadaSiasgWsService;
    }

    /**
     * Exibir uma listagem da Contratada.
     *
     */
    public function index()
    {
        $mode = "";
        $listaMunicipio = [null => "Selecione"];
        $listaUF = [null => "Selecione"];
        $listaTipoContratada = TipoContratada::getConstants();
        
        return view('gescon::contratadas.index', compact('mode', 'listaTipoContratada', 'listaMunicipio', 'listaUF'));
    }

    /**
     * Recuperar os registros de Contratadas cadastrados
     *
     */
    public function records(Request $request)
    {   
        $contratadas = $this->contratadaRepository->findAllOrderByName();
        return Datatables::of($contratadas)
                
                ->addColumn('in_tipo_contratada', function ($contratada) {
                                return $contratada->descricao_tipo_contratada;
                            })
                ->addColumn('nr_cpf_cnpj', function ($contratada) {
                                return $contratada->nr_cpf_cnpj;
                            })
                ->addColumn('no_razao_social', function ($contratada) {
                                return $contratada->no_razao_social;
                            })

                ->addColumn('operacoes', function ($contratada) {
                    return "<a href='#' data-url=".url('gescon/contratadas/edit/'.$contratada->id_contratada.'')." class='btn btn-xs btn-info update'>
                                <i class='ace-icon fa fa-pencil'></i>
                            </a>
                            <a href='#' data-id='{{ $contratada->id_contratada }}' data-url=".url('gescon/contratadas/destroy/'.$contratada->id_contratada.'')." class='btn btn-xs btn-danger delete'>
                                <i class='ace-icon fa fa-trash-o'></i>
                            </a>   ";
                            })
                ->rawColumns(['operacoes'])
                ->make(true);
    }

    /**
     * Mostre o formulário para criar um nova Contratada.
     *
     */
    public function create()
    {   
        $mode = "create";
        $listaTipoContratada = TipoContratada::getConstants();
        $listaMunicipio = $this->municipioRepository->listsByAttribute('no_municipio','id_municipio','id_uf','11');
        $listaUF = $this->ufRepository->lists('sg_uf','id_uf');

        $html = view('gescon::contratadas._modal', compact('mode', 'listaTipoContratada', 'listaMunicipio', 'listaUF'))->render(); 

        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);
    }

    /**
     * Insere uma Contratadas recentemente criado.
     *
     * @param ContratadaRequest $request
     *
     */
    public function store(ContratadaRequest $request)
    {
        try{

            $this->contratadaRepository->create($request->all());            
            $html = $this->renderizarTabela();
            return response(['msg' => trans('alerts.registro.created'), 'status' => 'success', 'html'=> $html]);    

        }catch (\Exception $e){

            $html = $this->renderizarTabela();
            return response(['msg' => trans('alerts.registro.createdError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
    }

    /**
     * Mostra o formulário para editar uma Contratada especificado.
     *
     * @param  int $id
     *
     */
    public function edit($id)
    {
        $mode = "update";
        $listaTipoContratada = TipoContratada::getConstants();
        $contratada = $this->contratadaRepository->find($id);
        $municipioContratada = $this->municipioRepository->find($contratada->id_municipio_logradouro);
        $id_uf = $municipioContratada->uf->id_uf;
        $contratada['id_uf_logradouro'] = $id_uf;
        $listaMunicipio = $this->municipioRepository->listsByAttribute('no_municipio','id_municipio','id_uf',$id_uf);
        $listaUF = $this->ufRepository->lists('sg_uf','id_uf');
        $html = view('gescon::contratadas._modal', compact('contratada', 'mode', 'listaTipoContratada', 'listaMunicipio', 'listaUF'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'html'=> $html]);    
    }

    /**
     * Atualiza uma Contratada especificada.
     *
     * @param  int $id
     * @param ContratadaRequest $request
     *
     * @return Response
     */
    public function update($id, ContratadaRequest $request)
    {
        try{

            $contratada = $this->contratadaRepository->update($request->all(), $id);    
            $html = $this->renderizarTabela();
            return response(['msg' => trans('alerts.registro.updated'), 'status' => 'success', 'html'=> $html]);    

        }catch (\Exception $e){

            $html = $this->renderizarTabela();
            return response(['msg' => trans('alerts.registro.updatedError'), 'detail' => $e->getMessage(), 'status' => 'error']);

        }
        
    }

    /**
     * Remove uma Contratada específica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            $this->contratadaRepository->find($id)->delete();
            $html = $this->renderizarTabela();
            
            return response(['msg' => trans('alerts.registro.deleted'), 'status' => 'success', 'html'=> $html]);

        }catch(Exception $e){

            return response(['msg' => trans('alerts.registro.deletedError'), 'detail' => $e->getMessage(), 'status' => 'error']);
            
        }     
    }

    /**
     * Método responsável por recuperar dados das Contratadas do WS do SIASG
     * 
     * @return View
     */
    public function findContratadaWsByCNPJ($cnpj)
    {
        $retorno = array();
        $contratada = $this->contratadaSiasgWsService->findContratadaByCnpj($cnpj);

        if (!empty($contratada)){
            $retorno['no_razao_social'] = $contratada->razao_social->__toString();
            $municipio = $this->municipioRepository->findByCodigoSiorg(substr($contratada->id_municipio, 0, 4));    
            $uf = $municipio[0]->uf;
            $retorno['id_uf_logradouro'] = $uf['id_uf'];
            $retorno['id_municipio_logradouro'] = $municipio[0]['id_municipio'];
            $retorno['lista_municipios'] = $uf->municipios;
            $retorno['ed_cep_logradouro'] = $contratada->cep->__toString();
            $retorno['ed_logradouro'] = $contratada->logradouro->__toString();
            $retorno['ed_numero_logradouro'] = $contratada->numero_logradouro->__toString();
            $retorno['ed_complemento_logradouro'] = $contratada->complemento_logradouro->__toString();
            $retorno['ed_bairro_logradouro'] = $contratada->bairro->__toString();
            $retorno['st_cadastro'] = 'WS';
        }
        return json_encode($retorno);
    }

    /**
     * Método responsável por recuperar dados das contratadas do BD, caso não encontre, ele busca do WS do SIASG
     * 
     * @return View
     */
    public function findContratadaByCNPJ($cnpj)
    {
        $retorno = array();
        $contratada = $this->contratadaRepository->findByCNPJ($cnpj);

        if (!empty($contratada)){
            
            $retorno['id_contratada'] = $contratada->id_contratada;
            $retorno['no_razao_social'] = $contratada->no_razao_social;
            $municipio = $this->municipioRepository->find($contratada->id_municipio_logradouro);    
            $uf = $municipio->uf;
            $retorno['id_uf_logradouro'] = $uf->id_uf;
            $retorno['id_municipio_logradouro'] = $contratada->id_municipio_logradouro;
            $retorno['lista_municipios'] = $uf->municipios;
            $retorno['ed_cep_logradouro'] = $contratada->ed_cep_logradouro;
            $retorno['ed_logradouro'] = $contratada->ed_logradouro;
            $retorno['ed_numero_logradouro'] = $contratada->ed_numero_logradouro;
            $retorno['ed_complemento_logradouro'] = $contratada->ed_complemento_logradouro;
            $retorno['ed_bairro_logradouro'] = $contratada->ed_bairro_logradouro;
            $retorno['no_representante'] = $contratada->no_representante;
            $retorno['nr_telefone'] = $contratada->nr_telefone;
            $retorno['ds_email'] = $contratada->ds_email;
            $retorno['st_cadastro'] = 'BD';

        }else{

            return $this->findContratadaWsByCNPJ($cnpj);

        }
        
        return json_encode($retorno);
    }


    /**
     * Método responsável por renderizar a tabela da página de listagem
     * 
     * @return View
     */
    private function renderizarTabela()
    {
        $contratadas = $this->contratadaRepository->all();
        return view('gescon::contratadas._tabela', compact('contratadas'))->render(); 
    }
}
