<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use SoapClient;
use Exception;
use Carbon\Carbon;

class ParlamentarSenadoWsService extends SenadoWsService
{
	
	const COMPLEMENTO_WSDL = 'senador';

	/**
	* Recuperar os dados da função passada por parametros
	* @param  string $funcao
	* @param  array $parametros
	* @return string
	*/
	private function _obterDados($funcao, $parametros)
	{
		try{

			return parent::getClient($funcao, self::COMPLEMENTO_WSDL, $parametros);

	   }catch(Exception $e){

	       return null;

	   }

	}


	/**
	* Recuperar dados do deputado no WS através do ID
	* @param integer idParlamentar
	* @return Parlamentar
	*/
	public function findParlamentarById($idParlamentar)
	{
		
		$parlamentarWS = [];
		$array_Retorno = [];
		$parlamentarWS = $this->_obterDados($idParlamentar, array());

		if (count($parlamentarWS->children()) > 1){

			try{
				
				array_push($array_Retorno, ['dadosParlamentar' => $this->_preparaDadosParlamentar($parlamentarWS->Parlamentar)]);
				array_push($array_Retorno, ['dadosFiliacaoPartidaria' => $this->_preparaFiliacaoPartidaria($parlamentarWS->Parlamentar)]);

				return $array_Retorno;

			}catch (Exception $e){
				
				throw new Exception('Erro: Não foi possível encontrar o parlamentar.', 999);

			}

		}else{

			return null;

		}
		
	}

	/**
	* Configura os dados básicos do Parlamentar para gravação no BD
	* @param array arrayDadosParlamentar
	* @return Collection 
	*/
	private function _preparaDadosParlamentar($arrayDadosParlamentar)
	{
		
		$collectionDadosParlamentar = new Collection;
		
		$dadosIdentificacaoParlamentar = $arrayDadosParlamentar->IdentificacaoParlamentar;
		$dadosBasicosParlamentar = $arrayDadosParlamentar->DadosBasicosParlamentar;
		
		$collectionDadosParlamentar->put('co_parlamentar', $dadosIdentificacaoParlamentar->CodigoParlamentar);
		$collectionDadosParlamentar->put('no_parlamentar', trim($dadosIdentificacaoParlamentar->NomeParlamentar));
		$collectionDadosParlamentar->put('no_civil', trim($dadosIdentificacaoParlamentar->NomeCompletoParlamentar));
		$collectionDadosParlamentar->put('in_sexo', trim(substr($dadosIdentificacaoParlamentar->SexoParlamentar, 0, 1)));
		$collectionDadosParlamentar->put('in_cargo', 'SEN');
		$collectionDadosParlamentar->put('dt_nascimento', $dadosBasicosParlamentar->DataNascimento);
		$collectionDadosParlamentar->put('sg_uf_parlamentar', trim($dadosIdentificacaoParlamentar->UfParlamentar));
		$collectionDadosParlamentar->put('ds_email', trim($dadosIdentificacaoParlamentar->EmailParlamentar));
		$collectionDadosParlamentar->put('aq_foto', trim($dadosIdentificacaoParlamentar->UrlFotoParlamentar));
		
		$snExercicio = $this->_findParlamentarLegislaturaAtualById($dadosIdentificacaoParlamentar->CodigoParlamentar,
																		$dadosIdentificacaoParlamentar->UfParlamentar);
		
		$collectionDadosParlamentar->put('sn_exercicio', $snExercicio);
	
		return $collectionDadosParlamentar;

	}

	/**
	* Verifica se o parlamentar está em exercício na Legislatura Atual
	* @param integer idParlamentar
	* @param string ufParlamentar
	* @return Collection 
	*/
	private function _findParlamentarLegislaturaAtualById($idParlamentar, $ufParlamentar)
	{
		
		$parlamentarWS = $this->_obterDados('lista/atual', array('uf' => $ufParlamentar));

		try{

			if (count($parlamentarWS->children()) > 1){
				
				if (count($parlamentarWS->Parlamentares->children()) > 0){
					
					$parlamentares = $parlamentarWS->Parlamentares->children();

					foreach ($parlamentares as $parlamentar) {
						
						if (trim($idParlamentar) == trim($parlamentar->children()->IdentificacaoParlamentar->CodigoParlamentar)){

							return 1;

						}

					}  
					
				}

			}

			return 0;

			
		}catch (Exception $e){

			return 0;

		}

	}

	
	/**
	* Configura os dados referentes a Filiação Partidária do Parlamentar para gravação no BD
	* @param array arrayDadosParlamentar
	* @return Collection 
	*/
	private function _preparaFiliacaoPartidaria($arrayDadosParlamentar)
	{

		$i = 0;
		$collectionDadosParlamentar = new Collection;
		$idParlamentar = $arrayDadosParlamentar->IdentificacaoParlamentar->CodigoParlamentar;
		$parlamentarWS = $this->_obterDados($idParlamentar.'/filiacoes', array());
		
		try{

			if (count($parlamentarWS->children()) > 1){
				
				if (count($parlamentarWS->children()->Parlamentar->children()) > 0){
					
					$filiacoes = $parlamentarWS->children()->Parlamentar->Filiacoes->children();

					foreach ($filiacoes as $filiacao) {

						$array = array(
							'sg_partido' => $filiacao->children()->Partido->SiglaPartido,
							'no_partido' => $filiacao->children()->Partido->NomePartido,
							'dt_filiacao_inicio' => $filiacao->children()->DataFiliacao,
							'dt_filiacao_fim' => $filiacao->children()->DataDesfiliacao
						);

						$collectionDadosParlamentar->put($i++, $array);

					}  
					
				}

			}

			return $collectionDadosParlamentar;

			
		}catch (Exception $e){

			return null;

		}

	}
}