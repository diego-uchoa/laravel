<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\ProposicaoRepository;
use App\Modules\Parla\Repositories\ConsultaMfRepository;
use App\Modules\Parla\Repositories\RespostaMfRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Exception\HttpResponseException;
use Exception;
use Mail;
use DB;

class ProposicaoService {
	protected $proposicaoRepository;
	protected $proposicaoSenadoWsService;
	protected $proposicaoCamaraWsService;
	protected $emendaService;
	protected $substitutivoService;
	protected $materiaRelacionadaService;
	protected $apensadoService;
	protected $tramitacaoService;
	protected $autoriaService;
	protected $consultaMfRepository;
	protected $respostaMfRepository;

	public function __construct(ProposicaoRepository $proposicaoRepository, ProposicaoCamaraWsService $proposicaoCamaraWsService, ProposicaoSenadoWsService $proposicaoSenadoWsService, EmendaService $emendaService, SubstitutivoService $substitutivoService, MateriaRelacionadaService $materiaRelacionadaService, ApensadoService $apensadoService, TramitacaoService $tramitacaoService, AutoriaService $autoriaService, ConsultaMfRepository $consultaMfRepository,
        RespostaMfRepository $respostaMfRepository) {
		$this->proposicaoRepository = $proposicaoRepository;
		$this->proposicaoCamaraWsService = $proposicaoCamaraWsService;
		$this->proposicaoSenadoWsService = $proposicaoSenadoWsService;
		$this->emendaService = $emendaService;
		$this->substitutivoService = $substitutivoService;
		$this->materiaRelacionadaService = $materiaRelacionadaService;
		$this->apensadoService = $apensadoService;
		$this->tramitacaoService = $tramitacaoService;
		$this->autoriaService = $autoriaService;
		$this->consultaMfRepository = $consultaMfRepository;
		$this->respostaMfRepository = $respostaMfRepository;
	}

	/**
	 * Método responsável por buscar/atualizar a Proposição enviado por parametro
	 *
	 * @param Integer $id
	 * @return Proposicao
	 */
	public function show($id) {
		
		$proposicaoBD = $this->proposicaoRepository->find($id);
		$dataAtualizacao = explode(" ", $proposicaoBD->updated_at)[0];
		if ($dataAtualizacao == date('d/m/Y')) {

			return $proposicaoBD;

		}
		else {

			try {

				$dadosProposicao = $this->findDadosProposicaoWsBySiglaOrigem($proposicaoBD->sg_casa_origem, $proposicaoBD->sg_sigla_origem, $proposicaoBD->nr_numero_origem, $proposicaoBD->an_ano_origem);
				$dadosRevisora = $this->findRevisoraByOrigem($dadosProposicao);

				DB::beginTransaction();

					$this->atualizaProposicao($dadosProposicao + $dadosRevisora, $proposicaoBD);
				
				DB::commit();

				return $this->proposicaoRepository->find($id);

			} catch(Exception $e) {
				
				DB::rollBack();
				$this->envioEmailErro($proposicaoBD->nr_numero_origem, $proposicaoBD->an_ano_origem, $proposicaoBD->sg_casa_origem, $proposicaoBD->sg_sigla_origem, $e->getMessage(), 'Atualização da Proposição por meio do método Show.');
				throw new Exception('Não foi possível recuperar a proposição selecionada: '.$e->getMessage(), 1);

			}
		}
	}

	/**
	 * Método responsável por gravar/atualizar a Proposição enviado por parametro
	 *
	 * @param Array $proposicao
	 * @return Array
	 */
	public function store($proposicao) {
		
		$resultadoProposicaoBD = $this->proposicaoRepository->findBySiglaNumeroAno($proposicao['sg_casa'],$proposicao['sg_sigla'],$proposicao['nr_numero'],$proposicao['an_ano']);

		if(!$resultadoProposicaoBD->isEmpty()) {
			foreach ($resultadoProposicaoBD as $proposicaoBD) {
				
				$dataAtualizacao = explode(" ", $proposicaoBD->updated_at)[0];
				if ($dataAtualizacao == date('d/m/Y') && !$proposicaoBD->deleted_at) {
					return array('msg' => 'Proposição já cadastrada!', 'status' => 'success', 'id' => $proposicaoBD->id_proposicao);
				}
				else {
					if($this->_existeProposicao($proposicaoBD['sg_casa_origem'],$proposicaoBD['sg_sigla_origem'],$proposicaoBD['nr_numero_origem'],$proposicaoBD['an_ano_origem'])) {
						try {

							$dadosProposicao = $this->findDadosProposicaoWsBySiglaOrigem($proposicaoBD->sg_casa_origem, $proposicaoBD->sg_sigla_origem, $proposicaoBD->nr_numero_origem, $proposicaoBD->an_ano_origem);
							$dadosRevisora = $this->findRevisoraByOrigem($dadosProposicao);

							DB::beginTransaction();

								if ($proposicaoBD->deleted_at){
									$proposicaoBD->restore();
									$restaurado = true;
								}
								else {
									$restaurado = false;
								}

								$this->atualizaProposicao($dadosProposicao + $dadosRevisora, $proposicaoBD);
								$this->consultaMfRepository->restoreDeleted([['id_proposicao','=',$proposicaoBD->id_proposicao]]);
								$this->respostaMfRepository->restoreDeleted([['id_proposicao','=',$proposicaoBD->id_proposicao]]);
							
							DB::commit();

							if ($restaurado) {
								return array('msg' => 'Proposição reativada!', 'status' => 'success', 'id' => $proposicaoBD->id_proposicao);
							}
							else {
								return array('msg' => 'Proposição atualizada com sucesso!', 'status' => 'success', 'id' => $proposicaoBD->id_proposicao);	
							}

						} catch(Exception $e) {
							
							DB::rollBack();
							// $this->envioEmailErro($proposicaoBD->nr_numero_origem, $proposicaoBD->an_ano_origem, $proposicaoBD->sg_casa_origem, $proposicaoBD->sg_sigla_origem, $e->getMessage(), 'Atualização da Proposição por meio do método Store (Proposição já existente).');
							throw new Exception('Não foi possível recuperar a proposição informada: '.$e->getMessage(), 1);

						}
					}
					else {
						return array('msg' => 'Proposição não encontrada no Web Service!', 'status' => 'error', 'id' => 0);
					}
				}		
			}
		}
		else {
			if($this->_existeProposicao($proposicao['sg_casa'],$proposicao['sg_sigla'],$proposicao['nr_numero'],$proposicao['an_ano'])) {
				if($this->_isOrigem($proposicao['sg_casa'],$proposicao['sg_sigla'],$proposicao['nr_numero'],$proposicao['an_ano'])) {
					
					$dadosProposicao = $this->findDadosProposicaoWsBySiglaOrigem($proposicao['sg_casa'],$proposicao['sg_sigla'],$proposicao['nr_numero'],$proposicao['an_ano']);
					$dadosRevisora = $this->findRevisoraByOrigem($dadosProposicao);

					try {

						DB::beginTransaction();

						$proposicao = $this->proposicaoRepository->create($dadosProposicao + $dadosRevisora);

						$this->autoriaService->store($proposicao);
						$this->emendaService->store($proposicao);
						$this->substitutivoService->store($proposicao);
						$this->materiaRelacionadaService->store($proposicao);
						$this->apensadoService->store($proposicao);
						$this->tramitacaoService->store($proposicao);

						DB::commit();

						return array('msg' => 'Proposição cadastrada com sucesso!', 'status' => 'success', 'id' => $proposicao->id_proposicao);

					} catch(\Exception $e) {
						
						DB::rollBack();
						$this->envioEmailErro($proposicao['nr_numero'],$proposicao['an_ano'], $proposicao['sg_casa'], $proposicao['sg_sigla'], $e->getMessage(), 'Atualização da Proposição por meio do método Store (Proposição Nova).');
						throw new Exception('Não foi possível realizar o cadastro da proposição: '.$e->getMessage(), 1);

					}
				}
				else {
					return array('msg' => 'A busca de proposição deve ser feita apenas pelo número de origem dela!', 'status' => 'error', 'id' => 0);
				}
			}
			else {
				return array('msg' => 'Proposição não encontrada no Web Service!', 'status' => 'error', 'id' => 0);
			}
		}
	}

	/**
	 * Recupera dados do Revisora da Proposição do WS da Casa de Revisora (CD ou SF)
	 *
	 * @param String 
	 * @return Array
	 */
	public function findRevisoraByOrigem($proposicao) {
		$dadosRevisora = array();

		if($proposicao['sg_casa_origem'] == 'CD') {
			$dadosRevisora = $this->proposicaoSenadoWsService->findRevisoraByOrigem($proposicao['sg_sigla_origem'], $proposicao['nr_numero_origem'], $proposicao['an_ano_origem']);
		}
		else if($proposicao['sg_casa_origem'] == 'SF') {
			$outrosNumeros = $this->proposicaoSenadoWsService->findOutrosNumerosByOrigem($proposicao['sg_sigla_origem'], $proposicao['nr_numero_origem'], $proposicao['an_ano_origem']);
			if(!empty($outrosNumeros)) {
				$dadosRevisora = $this->proposicaoCamaraWsService->findRevisoraByOutrosNumeros($proposicao, $outrosNumeros);
			}
		}

		return $dadosRevisora;
	}

	/**
	 * Recupera dados da Proposição do WS da Casa de Origem (CD ou SF)
	 *
	 * @param String $casa
 	 * @param String $sigla
 	 * @param String $numero
 	 * @param String $ano
	 * @return Array
	 */
	public function findDadosProposicaoWsBySiglaOrigem($casa, $sigla, $numero, $ano) {
		if($casa == 'CD') {
			return $this->proposicaoCamaraWsService->findOrigemBySiglaNumeroAno($sigla, $numero, $ano);
		}
		else if($casa == 'SF') {
			return $this->proposicaoSenadoWsService->findOrigemBySiglaNumeroAno($sigla, $numero, $ano);
		}
	}

	/**
	 * Verifica se existe Proposição cadastrada no WS (SF ou CD) de acordo com os parametros informados
	 *
	 * @param String $casa
	 * @param String $sigla
	 * @param String $numero
	 * @param String $ano
	 * @return Boolean
	 */
	private function _existeProposicao($casa, $sigla, $numero, $ano) {
		if($casa == 'CD') {
			return $this->proposicaoCamaraWsService->existeProposicao($sigla, $numero, $ano);
		}
		else if($casa == 'SF') {
			return $this->proposicaoSenadoWsService->existeProposicao($sigla, $numero, $ano);
		}
	}

	/**
	 * Verifica se existe Proposição é tem como origem a CD ou SF, de acordo com os parametros informados
	 *
	 * @param String $casa
	 * @param String $sigla
	 * @param String $numero
	 * @param String $ano
	 * @return Boolean
	 */
	private function _isOrigem($casa, $sigla, $numero, $ano) {
		if($casa == 'CD') {
			return $this->proposicaoCamaraWsService->isOrigem($sigla, $numero, $ano);
		}
		else if($casa == 'SF') {
			return $this->proposicaoSenadoWsService->isOrigem($sigla, $numero, $ano);
		}
	}

	/**
	 * Método responsável por atualizar os dados da Proposição de acordo com os dados retornados do WS
	 *
	 * @param Array $proposicaoWS
	 * @param Array $proposicaoBD
	 */
	public function atualizaProposicao($proposicaoWS, $proposicaoBD) {
		
		$this->proposicaoRepository->update($proposicaoWS, $proposicaoBD->id_proposicao);
		$proposicao = $this->proposicaoRepository->find($proposicaoBD->id_proposicao);
		$this->autoriaService->store($proposicao);
		$this->tramitacaoService->store($proposicao);
		$this->emendaService->store($proposicao);
		$this->substitutivoService->store($proposicao);
		$this->apensadoService->store($proposicao);
		$this->materiaRelacionadaService->store($proposicao);


	}

	/**
	 * Método responsável por envior mensagem de erro aos responsáveis pelo Parla, no processo de inclusão/atualização da Proposição
	 *
	 * @param String $numero
	 * @param String $ano
	 * @param String $casa
	 * @param String $tipo
	 * @param String $erro
	 * @param String $origemErro
	 */
	public function envioEmailErro($numero, $ano, $casa, $tipo, $erro, $origemErro){
		
		Mail::send('parla::layouts.emails.email-aviso-erro-atualizacao-proposicao', 
		                [
		                    'numero' => $numero,
		                    'ano' => $ano,
		                    'casa' => $casa,
		                    'tipo' => $tipo,
		                    'origemErro' => $origemErro,
		                    'erro' => $erro,
		                ], 
		                function($message){
		    
		                    $message->subject('Erro ao Atualizar Proposição do PARLA');
		                    $message->from('parla@fazenda.gov.br', 'Portal de Sistemas - PARLA');
		                    $message->to("andre.boaro@fazenda.gov.br");
		                    $message->cc("luisa.palmeira@fazenda.gov.br");

		});

	}
}