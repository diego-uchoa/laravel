<?php
namespace App\Modules\Parla\Services;

use Illuminate\Support\Collection;
use Exception;
use Carbon\Carbon;

class ParlamentarCamaraWsService extends CamaraWsService
{
	const COMPLEMENTO_WSDL = 'Deputados';

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

	        return $e;

	    }

	}


	/**
	* Recuperar dados do deputado no WS através do ID
	* @param integer idParlamentar
	* @return Parlamentar
	*/
	public function findParlamentarById($idParlamentar)
	{
		$deputadolWS = [];
		$array_DeputadoOrdenado = [];
		$array_Retorno = [];
		$parametros = ['ideCadastro' => $idParlamentar, 'numLegislatura' => ''];
		$deputadolWS = $this->_obterDados('ObterDetalhesDeputado', $parametros);

		if ($deputadolWS['status'] != 'error'){

			try{
				
				if (sizeof($deputadolWS) > 0){

					foreach ($deputadolWS as $deputado) {
						
						$array_DeputadoOrdenado[(string) $deputado->numLegislatura] = $deputado;
					}  
					ksort($array_DeputadoOrdenado);
					
					array_push($array_Retorno, ['dadosParlamentar' => $this->_preparaDadosParlamentar(array_reverse($array_DeputadoOrdenado))]);
					array_push($array_Retorno, ['dadosFiliacaoPartidaria' => $this->_preparaFiliacaoPartidaria(array_reverse($array_DeputadoOrdenado))]);

					return $array_Retorno;

				}else{

					return null;

				}
				
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
		$collectionDadosDeputado = new Collection;

		for ($i = 0; $i < 1; $i++){

			$collectionDadosDeputado->put('co_parlamentar', $arrayDadosParlamentar[$i]->ideCadastro);
			$collectionDadosDeputado->put('no_parlamentar', $arrayDadosParlamentar[$i]->nomeParlamentarAtual);
			$collectionDadosDeputado->put('no_civil', $arrayDadosParlamentar[$i]->nomeCivil);
			$collectionDadosDeputado->put('in_sexo', $arrayDadosParlamentar[$i]->sexo);
			$collectionDadosDeputado->put('in_cargo', 'DEP');
			$collectionDadosDeputado->put('dt_nascimento', $arrayDadosParlamentar[$i]->dataNascimento);
			$collectionDadosDeputado->put('sg_uf_parlamentar', $arrayDadosParlamentar[$i]->ufRepresentacaoAtual);
			$collectionDadosDeputado->put('ds_email', $arrayDadosParlamentar[$i]->email);
			
			$outrosDados = $this->_findParlamentarLegislaturaAtualById($arrayDadosParlamentar[$i]->ideCadastro);
			$collectionDadosDeputado->put('sn_exercicio', $outrosDados['sn_exercicio']);
			$collectionDadosDeputado->put('aq_foto', $outrosDados['aq_foto']);
		}

		return $collectionDadosDeputado;

	}


	/**
	* Verifica se o parlamentar está em exercício na Legislatura Atual
	* @param integer idParlamentar
	* @return Collection 
	*/
	private function _findParlamentarLegislaturaAtualById($idParlamentar)
	{
		$collectionDados = new Collection;
		$deputadolWS = $this->_obterDados('ObterDeputados', array());

		try{

			if (sizeof($deputadolWS) > 0){

				foreach ($deputadolWS as $deputado) {
					
					if (trim($idParlamentar) == trim($deputado->ideCadastro)){

						$collectionDados->put('aq_foto', $deputado->urlFoto);
						$collectionDados->put('sn_exercicio', true);
						return $collectionDados;

					}

				}  

				$collectionDados->put('aq_foto', '');
				$collectionDados->put('sn_exercicio', 0);
				return $collectionDados;
				
			}else{

				$collectionDados->put('aq_foto', '');
				$collectionDados->put('sn_exercicio', 0);
				return $collectionDados;

			}
			
		}catch (Exception $e){

			$collectionDados->put('aq_foto', '');
			$collectionDados->put('sn_exercicio', 0);
			return $collectionDados;

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
		$collectionDadosDeputado = new Collection;
		$dataFiliacaoInicio = "";
		
		$legislatura_parlamentar = array_reverse($arrayDadosParlamentar);
		$qtd_legislatura = count($legislatura_parlamentar);

		for ($j = 0; $j < $qtd_legislatura; $j++){

			if (count($legislatura_parlamentar[$j]->filiacoesPartidarias->children()) > 0){

				foreach ($legislatura_parlamentar[$j]->filiacoesPartidarias->children() as $filiacao) {
				
					$dataFiliacaoFim = Carbon::createFromFormat('d/m/Y', $filiacao->dataFiliacaoPartidoPosterior)->subDay();

					$array = array(
						'sg_partido' => $filiacao->siglaPartidoAnterior,
						'no_partido' => $filiacao->nomePartidoAnterior,
						'dt_filiacao_inicio' => $dataFiliacaoInicio,
						'dt_filiacao_fim' => $dataFiliacaoFim
					);
					$dataFiliacaoInicio = Carbon::createFromFormat('d/m/Y', $filiacao->dataFiliacaoPartidoPosterior);

					$collectionDadosDeputado->put($i++, $array);
				}

			}

			if ($j == ($qtd_legislatura - 1)){

				//RECUPERANDO O PARTIDO ATUAL
				$array = array(
					'sg_partido' => $legislatura_parlamentar[$j]->partidoAtual->sigla,
					'no_partido' => $legislatura_parlamentar[$j]->partidoAtual->nome,
					'dt_filiacao_inicio' => $dataFiliacaoInicio,
					'dt_filiacao_fim' => ''
				);
				$collectionDadosDeputado->put($i++, $array);

			}

		}

		return $collectionDadosDeputado;

	}

}