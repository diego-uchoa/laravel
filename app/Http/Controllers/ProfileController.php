<?php

namespace App\Http\Controllers;

use App\Modules\Sisadm\Services\SiapeWsService;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Modules\Sisadm\Repositories\SiapeCargoRepository;
use App\Http\Controllers\Controller;
use App\Helpers\UtilHelper;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{

    protected $siapeWsService;
    protected $orgaoRepository;
    protected $cargoRepository;
    
    public function __construct(SiapeWsService $siapeWsService, 
                                    OrgaoRepository $orgaoRepository,
                                    SiapeCargoRepository $cargoRepository)
    {
        $this->siapeWsService = $siapeWsService;
        $this->orgaoRepository = $orgaoRepository;
        $this->cargoRepository = $cargoRepository;
    }

    /**
    * Método responsável por recuperar os Dados Pessoais e Funcionais do usuário logado no WS SIAPE e gravar no BD
    */
    public function index()
    {
        
        $dadosPessoais = $this->siapeWsService->findDadosPessoaisByCPF(UtilHelper::getUsername());
        $dadosFuncionais = $this->siapeWsService->findDadosFuncionaisByCPF(UtilHelper::getUsername());
        return view('profile', compact('dadosPessoais', 'dadosFuncionais'));
        
    }

    /**
    * Grava a foto selecionada pelo usuário em seu perfil
    * @param  Request $request
    * @return SiapeDadoPessoal
    */
    public function updatePhoto(Request $request)
    {
        
        $photo = $request->ds_foto;
        return $this->siapeWsService->updatePhoto(UtilHelper::getUsername(), $photo);

    }

    /**
    * Método responsável por recuperar os Dados Pessoais e Funcionais ativos do usuário informado no WS SIAPE e gravar no BD
    * @param  String $cpf
    * @return Array
    */
    public function findDadosServidorWsByCPF($cpf)
    {
        $retorno = array();
        $dadosPessoais = $this->siapeWsService->findDadosPessoaisByCPF($cpf);
        if ($dadosPessoais){
            $dadosFuncionais = $this->siapeWsService->findDadosFuncionaisByCPF($cpf);

            $retorno['nome'] = $dadosPessoais['no_pessoa'];
            $retorno['dt_nascimento'] = $dadosPessoais['dt_nascimento'];
            $retorno['in_estado_civil'] = $dadosPessoais['in_estado_civil'];
            foreach ($dadosFuncionais as $dadoFuncional)
            {

                if ($dadoFuncional['dt_ocorrencia_exclusao'] == "")
                {
                    $retorno['nr_siape'] = $dadoFuncional['nr_siape'];
                    
                    $orgao = $this->orgaoRepository->findByCodigoUorg($dadoFuncional['co_uorg_exercicio']);
                    $retorno['id_orgao'] = $orgao[0]->id_orgao;
                    $retorno['no_orgao'] = $orgao[0]->sg_orgao ." - ". $orgao[0]->no_orgao;

                    if ($dadoFuncional['co_cargo']){
                        $cargo = $this->cargoRepository->findByCodigo($dadoFuncional['co_cargo']);
                        $retorno['no_cargo'] = $cargo[0]->no_cargo;    
                    }else{
                        $retorno['no_cargo'] = "";    
                    }
                }

            }    
        }else{
            $retorno['nome'] = "";
            $retorno['dt_nascimento'] = "";
            $retorno['in_estado_civil'] = "";
            $retorno['nr_siape'] = "";
            $retorno['id_orgao'] = "";
            $retorno['no_orgao'] = "";
            $retorno['no_cargo'] = "";
        }
        
        return $retorno;
    }

}
