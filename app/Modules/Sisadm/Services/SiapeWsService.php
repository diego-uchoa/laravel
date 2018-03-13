<?php
namespace App\Modules\Sisadm\Services;

use App\Modules\Sisadm\Repositories\UserRepository;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Modules\Sisadm\Repositories\SiapeDadoPessoalRepository;
use App\Modules\Sisadm\Repositories\SiapeDadoFuncionalRepository;
use App\Modules\Sisadm\Repositories\SiapeCargoRepository;
use App\Modules\Sisadm\Repositories\SiapeSituacaoFuncionalRepository;
use MaskHelper;
use Illuminate\Support\Collection;
use SoapClient;
use Exception;

class SiapeWsService
{
	protected $userRepository;
	protected $orgaoRepository;
	protected $siapeDadoPessoalRepository;
	protected $siapeDadoFuncionalRepository;
	protected $siapeOrgaoWsService;
	protected $adldap;
	private $wsdl;
	private $siglaSistema;
	private $nomeSistema;
	private $senhaAcesso;
	private $coOrgao;
	private $parmExistPag;
	private $parmTipoVinculo;


	public function __construct(UserRepository $userRepository, 
									OrgaoRepository $orgaoRepository,
									SiapeDadoPessoalRepository $siapeDadoPessoalRepository,
									SiapeDadoFuncionalRepository $siapeDadoFuncionalRepository,
									SiapeCargoRepository $siapeCargoRepository,
									SiapeSituacaoFuncionalRepository $siapeSituacaoFuncionalRepository,
									SiapeOrgaoWsService $siapeOrgaoWsService)
	{
		$this->userRepository = $userRepository;
		$this->orgaoRepository = $orgaoRepository;
		$this->siapeDadoFuncionalRepository = $siapeDadoFuncionalRepository;
		$this->siapeDadoPessoalRepository = $siapeDadoPessoalRepository;
		$this->siapeCargoRepository = $siapeCargoRepository;
		$this->siapeSituacaoFuncionalRepository = $siapeSituacaoFuncionalRepository;
		$this->siapeOrgaoWsService = $siapeOrgaoWsService;
		$this->_configuraWS();
	}

	/**
	* Responsável por configurar os dados de acesso ao WS
	*/
	private function _configuraWS(){
		$this->wsdl = env('SIAPE_WSDL');
		$this->siglaSistema = env('SIAPE_SIGLA_SISTEMA');
		$this->nomeSistema = env('SIAPE_NOME_SISTEMA');
		$this->senhaAcesso = env('SIAPE_SENHA_ACESSO');
		$this->coOrgao = env('SIAPE_CO_ORGAO');
		$this->parmExistPag = env('SIAPE_PARM_EXIST_PAG');
		$this->parmTipoVinculo = env('SIAPE_PARM_TIPO_VINCULO');	
	}

	/**
	* Responsável por informar dados do contexto utilizado pelo WS
	*/
	private function _getContext()
	{
	    $opts = array(
	        'ssl' => array(
	            'verify_peer' => false,
	            'verify_peer_name' => false,
	            'allow_self_signed' => true
	        ));

	    $context = stream_context_create($opts);
	    return $context;
	}

	/**
	* Responsável por acessar o WebService e realizar a chamada da Função
	* @param  string $função
	* @param  string $cpf
	* @return mixed
	*/
	private function _getClient($funcao, $cpf)
	{
		try{

	        $client = new SoapClient($this->wsdl,
	                                 array('stream_context' => $this->_getContext(),
	                                       'cache_wsdl' => WSDL_CACHE_NONE));

	        $result = $client->__soapCall($funcao, array(
	                                            'siglaSistema' => $this->siglaSistema, 
	                                            'nomeSistema' => $this->nomeSistema, 
	                                            'senha' => $this->senhaAcesso, 
	                                            'cpf' => $cpf, 
	                                            'codOrgao' => $this->coOrgao, 
	                                            'parmExistPag' => $this->parmExistPag, 
	                                            'parmTipoVinculo' => $this->parmTipoVinculo,
	                                    ));    
	        return $result;

	    }catch(Exception $e){

	        return null;

	    }

	}

	/**
	* Recuperar dados pessoais da pessoa no WebService do SIAPE
	* @param  string $cpf
	* @return SiapeDadoPessoal
	*/
	public function findDadosPessoaisByCPF($cpf)
	{

	    return $this->storeDadosPessoais(MaskHelper::removeMascaraCpf($cpf));

	}

	/**
	* Recuperar dados funcionais da pessoa no WebService do SIAPE
	* @param  string $cpf
	* @return SiapeDadoFuncional
	*/
	public function findDadosFuncionaisByCPF($cpf)
	{
	    
	    return $this->storeDadosFuncionais(MaskHelper::removeMascaraCpf($cpf));

	}

	/**
	* Grava dados pessoais da pessoa recuperados do WebService do SIAPE na BD
	* @param  string $cpf
	* @return SiapeDadoPessoal
	*/
	public function storeDadosPessoais($cpf)
	{
		$id_usuario = null;
		$usuario = $this->userRepository->findByCPF($cpf);
		if (!$usuario->isEmpty())
		{
			$id_usuario = $usuario[0]->id_usuario;
		}

		$siapeDadoPessoalWS = $this->_getClient('consultaDadosPessoais', $cpf);    
		return $this->siapeDadoPessoalRepository->store($id_usuario, $cpf, $siapeDadoPessoalWS);

	}    

	/**
	* Atualiza a foto da pessoa na BD
	* @param  string $photo
	* @return SiapeDadoPessoal
	*/
	public function updatePhoto($cpf, $photo)
	{

		return $this->siapeDadoPessoalRepository->updatePhoto($cpf, $photo);

	}    

	/**
	* Grava dados funcionais da pessoa recuperados do WebService do SIAPE na BD
	* @param  string $cpf
	* @return SiapeDadoFuncional
	*/
	public function storeDadosFuncionais($cpf)
	{
		
		$siapeDadoFuncionalWS = $this->_getClient('consultaDadosFuncionais', $cpf);
	    $this->_storeDadosPessoaisChefia($siapeDadoFuncionalWS);
	    $this->_storeOrgaos($siapeDadoFuncionalWS);
	  	$this->_storeCargo($siapeDadoFuncionalWS);
	    $this->_storeSituacaoFuncional($siapeDadoFuncionalWS);
	    return $this->siapeDadoFuncionalRepository->store($cpf, $siapeDadoFuncionalWS);
	    
	} 

	/**
	* Grava os Órgãos associados ao servidor (Exercicio, Lotação, UPAG)
	* @param  SiapeDadoFuncional $siapeDadoFuncionalWS
	*/
	private function _storeOrgaos($siapeDadoFuncionalWS)
	{
	 	
	 	$this->siapeOrgaoWsService->storeOrgaos($siapeDadoFuncionalWS);

	}

	/**
	* Grava dados pessoais da chefia da pessoa recuperados do WebService do SIAPE na BD
	* @param  SiapeDadoFuncional $siapeDadoFuncionalWS
	* @return SiapeDadoPessoal
	*/
	private function _storeDadosPessoaisChefia($siapeDadoFuncionalWS)
	{
	 	   
	    $cpfChefias = $this->findCPFChefiaImediataByDadosFuncionaisWS($siapeDadoFuncionalWS);

	    foreach ($cpfChefias as $cpfChefia) {
	    	$this->storeDadosPessoais($cpfChefia);
		}

	}

	/**
	* Grava o cargo da pessoa recuperada do WebService do SIAPE na BD
	* @param  SiapeDadoFuncional $siapeDadoFuncionalWS
	* @return Collection SiapeCargo
	*/
	private function _storeCargo($siapeDadoFuncionalWS)
	{
	 	
	 	return $this->siapeCargoRepository->store($siapeDadoFuncionalWS);	

	}

	/**
	* Grava a situação funcional da pessoa recuperada do WebService do SIAPE na BD
	* @param  SiapeDadoFuncional $siapeDadoFuncionalWS
	* @return Collection SiapeSituacaoFuncional
	*/
	private function _storeSituacaoFuncional($siapeDadoFuncionalWS)
	{
	 	
	 	return $this->siapeSituacaoFuncionalRepository->store($siapeDadoFuncionalWS);	

	}

	/**
	* Recupera o CPF da chefia imediata do servidor recuperado do WebService do SIAPE
	* @param  SiapeDadoFuncional
	* @return string $cpfChefia
	*/
	public function findCPFChefiaImediataByDadosFuncionaisWS($siapeDadoFuncionalWS)
	{
		$collection = new Collection;

		if ($siapeDadoFuncionalWS){

		    foreach ($siapeDadoFuncionalWS as $dadosFuncionais) {
		        
		        foreach ($dadosFuncionais as $dadoFuncional) {
		            
		        	$count = sizeof($dadoFuncional);

		        	if ($count > 1)
		        	{
		        	
		        		for ($i = 0; $i < $count; $i++){
		        		    
		        		    if ($dadoFuncional[$i]->cpfChefiaImediata != "")
		        		    {
		        		    	$cpfChefia = MaskHelper::removeMascaraCpf($dadoFuncional[$i]->cpfChefiaImediata);
		        		    	$collection->push($cpfChefia);	
		        		    }
		        		    
		        		}	
		        	
		        	}else{

		        		if ($dadoFuncional->cpfChefiaImediata != "")
		        		{
		        			$cpfChefia = MaskHelper::removeMascaraCpf($dadoFuncional->cpfChefiaImediata);
		        			$collection->push($cpfChefia);
		        		}

		        	}
		            
		        }

		    }

		}

		return $collection->unique();
	}

	
}