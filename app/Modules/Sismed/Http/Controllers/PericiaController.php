<?php

namespace App\Modules\Sismed\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Sismed\Http\Requests\AtestadoRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\UtilHelper;

use App\Modules\Sismed\Repositories\AtestadoRepository;
use App\Modules\Sismed\Repositories\ServidorRepository;
use App\Modules\Sismed\Repositories\PericiaRepository;
use App\Modules\Sismed\Enum\Situacao;
use App\Modules\Sismed\Enum\AreaAtendimento;
use App\Modules\Sismed\Enum\TipoAfastamento;
use App\Modules\Sismed\Enum\TipoPericia;

use App\Modules\Sismed\Services\AtestadoService;

use Storage;
use Carbon\Carbon;
use Mail;
use Session;
use Log;
use App\Http\Upload;
use PDF;

class PericiaController extends Controller
{
    protected $repository;
    protected $servidorRepository;
    protected $atestadoService;

    public function __construct(
        AtestadoService $atestadoService,
        PericiaRepository $repository, 
        ServidorRepository $servidorRepository,
        AtestadoRepository $atestadoRepository)
    {
        $this->atestadoService = $atestadoService;
        $this->repository = $repository;
        $this->servidorRepository = $servidorRepository;
        $this->atestadoRepository = $atestadoRepository;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pericia = $this->repository->find($id);
        $atestado = $this->atestadoRepository->find($pericia->id_atestado);
        $mode = "update";

        $dataInicioAfastamento = $pericia->dt_inicio_afastamento;
        $dataFimAfastamento = $pericia->dt_fim_afastamento;
        $dataPericia = $pericia->dt_pericia;
        
        $areaAtendimento = AreaAtendimento::getConstants();
        $tipoAfastamento = TipoAfastamento::getConstants();
        $tipoPericia = TipoPericia::getConstants();
        $situacao = Situacao::lists();

        $servidor = $this->servidorRepository->find($atestado->id_servidor);

        $html = view('sismed::servidor.atestado.pericia._modal', compact('pericia','atestado', 'mode','areaAtendimento','tipoAfastamento','tipoPericia','situacao','servidor'))->render(); 
        return response(['msg' => '', 'status' => 'success', 'dataInicioAfastamento' => $dataInicioAfastamento,'dataFimAfastamento' => $dataFimAfastamento, 'dataPericia' => $dataPericia,'html'=> $html]);    
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AtestadoRequest $request, $id)
    {

        
        try{

            if($request['laudo_delete'] == 'true' && $request->hasFile('laudo') == false){
                $request['no_laudo_fisico'] = '';  
            }else {
                $request['no_laudo_fisico'] = $request['laudo_atual'];
            }

            
            $servidor = $this->servidorRepository->find($request['id_servidor']);          


            if ($request->hasFile('laudo')) {
                
                $upload = Upload::uploadFile($request['laudo'],'storage_SISMED',$servidor->co_prontuario);
                $request['no_laudo_fisico'] = $upload['nome_arquivo'];
            
            }

            $pericia = $this->repository->find($id);
            $pericia->update($request->all());
        
            //Atualiza a situação do Atestado.
            $atualizaAtestado = $this->atestadoService->atualizaSituacao($pericia->id_atestado,$pericia);
            
            $mode = "";  

            if ( $request->ajax() ){
                $pericias = $this->repository->filterByIdAtestado($request['id_atestado']);
                $html = view('sismed::servidor.atestado.pericia._tabela', compact('pericias','servidor'))->render(); 
                return response(['msg' => 'Alterado com sucesso!', 'status' => 'success', 'html'=> $html, 'mode'=> $mode, 'atualiza' => $atualizaAtestado]);
            }
            else{
                $atestado = $this->atestadoRepository->find($request['id_atestado']);
                $servidor = $this->servidorRepository->find($request['id_servidor']);
                $pericias = $this->repository->filterByIdAtestado($request['id_atestado']);
                $areaAtendimento = AreaAtendimento::getConstants();
                $tipoAfastamento = TipoAfastamento::getConstants();
                $tipoPericia = TipoPericia::getConstants();
                $situacao = Situacao::lists();
                $mode = '';

                return view('sismed::servidor.atestado.edit', compact('atestado', 'mode','areaAtendimento','tipoAfastamento','tipoPericia','situacao','servidor','pericias'));
                

                
            }

        }
        catch(Exception $e){
            return response(['msg' => 'Erro ao atualizar o registro.', 'status' => 422]);
        }


    }


}