<?php
namespace App\Modules\Sisadm\Services;

use App\Modules\Sisadm\Repositories\UserRepository;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Repositories\MunicipioRepository;
use App\Modules\Sisadm\Repositories\SiapeDadoPessoalRepository;
use App\Modules\Sisadm\Repositories\SiapeDadoFuncionalRepository;
use App\Modules\Sisadm\Repositories\SiapeCargoRepository;
use App\Modules\Sisadm\Repositories\SiapeSituacaoFuncionalRepository;
use Illuminate\Support\Collection;
use App\Helpers\UtilHelper;
use SoapClient;
use Exception;

class SiapeOrgaoWsService
{
	protected $orgaoRepository;
	protected $municipioRepository;
	private $hierarquiaOrgao;
	private $wsdl;
	private $siglaSistema;
	private $nomeSistema;
	private $senhaAcesso;
	private $coOrgao;
	
	public function __construct(OrgaoRepository $orgaoRepository,
									MunicipioRepository $municipioRepository)
	{
		$this->orgaoRepository = $orgaoRepository;
		$this->municipioRepository = $municipioRepository;
		$this->hierarquiaOrgao = new Collection;
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
	private function _getClient($funcao, $uorg, $cpf)
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
	                                            'codUorg' => substr($uorg, -5), 
	                                    ));    
	        return $result;

	    }catch(Exception $e){

	        return null;

	    }

	}

	/**
	* Grava dados do órgão vinculado à pessoa recuperada do WebService do SIAPE na BD
	* @param SiapeDadoFuncional $siapeDadoFuncionalWS
	*/
	public function storeOrgaos($siapeDadoFuncionalWS)
	{
		
		if ($siapeDadoFuncionalWS){

            foreach ($siapeDadoFuncionalWS as $dadosFuncionais) {
                
                foreach ($dadosFuncionais as $dadoFuncional) {
                    
					$count = sizeof($dadoFuncional);

                    if ($count > 1)
                    {
                        for ($i = 0; $i < sizeof($dadoFuncional); $i++){
                            
                        	$orgaosExercicio = null;
                        	$orgaosLotacao = null;
                        	$orgaosUpag = null;

							if ($dadoFuncional[$i]->codUorgExercicio != "")
							{
							    $b = 0;
							    $orgaoBD_Exercicio = $this->findOrgaoByCodigoUorg($dadoFuncional[$i]->codUorgExercicio);

							    if ($orgaoBD_Exercicio->isEmpty()){

							    	$orgaosExercicio = $this->_preparaOrgao($dadoFuncional[$i]->codUorgExercicio);
							    	$idOrgaoPai = null;

							    	foreach ($orgaosExercicio->reverse() as $orgaoExercicio) {
							    		$registroOrgaoExercicio = $this->orgaoRepository->storeOrgaoWS($orgaoExercicio, $idOrgaoPai);
							    		$idOrgaoPai = $registroOrgaoExercicio->id_orgao;
							    		$this->getOrgaoCollection()->pop();
							    	}
							    	
							    }

							}

							if ($dadoFuncional[$i]->codUorgLotacao != "")
							{
								$j = 0;
							    $orgaoBD_Lotacao = $this->findOrgaoByCodigoUorg($dadoFuncional[$i]->codUorgLotacao);
							    
							    if ($orgaoBD_Lotacao->isEmpty()){

							    	$orgaosLotacao = $this->_preparaOrgao($dadoFuncional[$i]->codUorgLotacao);
							    	$idOrgaoPai = null;
							    	
							    	foreach ($orgaosLotacao->reverse() as $orgaoLotacao) {
							    		$registroOrgaoLotacao = $this->orgaoRepository->storeOrgaoWS($orgaoLotacao, $idOrgaoPai);
							    		$idOrgaoPai = $registroOrgaoLotacao->id_orgao;
							    		$this->getOrgaoCollection()->pop();
							    	}
							    	
							    }

							}

							if ($dadoFuncional[$i]->codUpag != "")
							{	
								$k = 0;
							    $orgaoBD_Upag = $this->findOrgaoByCodigoUorg($dadoFuncional[$i]->codUpag);

							    if ($orgaoBD_Upag->isEmpty()){

							    	$orgaosUpag = $this->_preparaOrgao($dadoFuncional[$i]->codUpag);
							    	$idOrgaoPai = null;

							    	foreach ($orgaosUpag->reverse() as $orgaoUpag) {
							    		$registroOrgaoUpag = $this->orgaoRepository->storeOrgaoWS($orgaoUpag, $idOrgaoPai);
							    		$idOrgaoPai = $registroOrgaoUpag->id_orgao;
							    		$this->getOrgaoCollection()->pop();
							    	}

							    }

							}	

                        }

                    }else{

                        if ($dadoFuncional->codUorgExercicio != "")
						{
							$i = 0;
						    $orgaoBD_Exercicio = $this->findOrgaoByCodigoUorg($dadoFuncional->codUorgExercicio);

						    if ($orgaoBD_Exercicio->isEmpty()){

						    	$orgaosExercicio = $this->_preparaOrgao($dadoFuncional->codUorgExercicio);
						    	$idOrgaoPai = null;

						    	foreach ($orgaosExercicio->reverse() as $orgaoExercicio) {
						    		$registroOrgao = $this->orgaoRepository->storeOrgaoWS($orgaoExercicio, $idOrgaoPai);
						    		$idOrgaoPai = $registroOrgao->id_orgao;
						    		$this->getOrgaoCollection()->pop();
						    	}
						    	
						    }

						}

						if ($dadoFuncional->codUorgLotacao != "")
						{
							$j = 0;
						    $orgaoBD_Lotacao = $this->findOrgaoByCodigoUorg($dadoFuncional->codUorgLotacao);

						    if ($orgaoBD_Lotacao->isEmpty()){

						    	$orgaosLotacao = $this->_preparaOrgao($dadoFuncional->codUorgLotacao);
						    	$idOrgaoPai = null;

						    	foreach ($orgaosLotacao->reverse() as $orgaoLotacao) {
						    		$registroOrgao = $this->orgaoRepository->storeOrgaoWS($orgaoLotacao, $idOrgaoPai);
						    		$idOrgaoPai = $registroOrgao->id_orgao;
						    		$this->getOrgaoCollection()->pop();
						    	}
						    	
						    }

						}

						if ($dadoFuncional->codUpag != "")
						{
							$k = 0;
						    $orgaoBD_Upag = $this->findOrgaoByCodigoUorg($dadoFuncional->codUpag);

						    if ($orgaoBD_Upag->isEmpty()){

						    	$orgaosUpag = $this->_preparaOrgao($dadoFuncional->codUpag);
						    	$idOrgaoPai = null;

						    	foreach ($orgaosUpag->reverse() as $orgaoUpag) {
						    		$registroOrgao = $this->orgaoRepository->storeOrgaoWS($orgaoUpag, $idOrgaoPai);
						    		$idOrgaoPai = $registroOrgao->id_orgao;
						    		$this->getOrgaoCollection()->pop();
						    	}
						    	
						    }

						}	

                    }    
                    
                }

            }

        }

	}  

	/**
	* Grava dados do órgão a partir do seu Código UORG
	* @param String $codigoUorg
	*/
	public function storeOrgaoByCodigo($codigoUorg)
	{
		$k = 0;
		$orgaoBD = $this->findOrgaoByCodigoUorg($codigoUorg);

	    if ($orgaoBD->isEmpty()){

	    	$orgaos = $this->_preparaOrgao($codigoUorg);

	    	$idOrgaoPai = null;

	    	foreach ($orgaos->reverse() as $orgao) {
	    		$registroOrgao = $this->orgaoRepository->storeOrgaoWS($orgao, $idOrgaoPai);
	    		$idOrgaoPai = $registroOrgao->id_orgao;
	    		$this->getOrgaoCollection()->pop();
	    	}

	    }

	}


	/**
	* Prepara dados dos orgaos vinculados a pessoa no WebService do SIAPE
	* @param  string $co_uorg
	* @return Collection
	*/
	private function _preparaOrgao($co_uorg)
	{
		$orgao = null;
		$siapeDadoOrgaoWS = $this->_getClient('dadosUorg', $co_uorg, UtilHelper::getUsername());

		if ($siapeDadoOrgaoWS)
		{
			if ($siapeDadoOrgaoWS->codUorgPai)
			{
				$orgaoBD_Pai = $this->findOrgaoByCodigoUorg($siapeDadoOrgaoWS->codUorgPai);

				if (sizeof($orgaoBD_Pai) > 0)
				{
				
					$orgao = $this->_montaHierarquiaOrgao($siapeDadoOrgaoWS, $orgaoBD_Pai);
					$this->setOrgaoCollection($orgao);
					
				}else{
					
					$orgao = $this->_montaHierarquiaOrgao($siapeDadoOrgaoWS, $orgaoBD_Pai);
					$this->setOrgaoCollection($orgao);
					$this->_preparaOrgao($siapeDadoOrgaoWS->codUorgPai);

				}

			}
		}

		return $this->getOrgaoCollection();

	}

	public function setOrgaoCollection($orgao)
	{
		$this->hierarquiaOrgao->push($orgao);		
	}

	public function getOrgaoCollection()
	{
		return $this->hierarquiaOrgao;		
	}

	/**
	* Monta a hierarquia dos orgaos vinculados a pessoa no WebService do SIAPE
	* @param  Orgao $siapeDadosOrgao
	* @param  boolean $inOrgaoPai
	* @return Collection
	*/
	private function _montaHierarquiaOrgao($siapeDadoOrgaoWS, $orgaoBD_Pai)
	{

		$municipio = $this->findMunicipioByCodigoSiorg($siapeDadoOrgaoWS->codMunicipio);
		$orgao = $this->orgaoRepository->montaOrgao($siapeDadoOrgaoWS, $orgaoBD_Pai, $municipio);
		return $orgao;

	}

	/**
	* Recuperar dados do orgao da pessoa no BD
	* @param  string $co_uorg
	* @return array
	*/
	public function findOrgaoByCodigoUorg($co_uorg)
	{

		return $this->orgaoRepository->findByCodigoUorg($co_uorg);

	}

	/**
	* Recuperar dados do municipio do orgao da pessoa no BD
	* @param  string $co_municipio_siorg
	* @return Municipio
	*/
	private function findMunicipioByCodigoSiorg($co_municipio_siorg)
	{

		return $this->municipioRepository->findByCodigoSiorg($co_municipio_siorg);

	}

}