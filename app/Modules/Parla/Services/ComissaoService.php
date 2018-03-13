<?php
namespace App\Modules\Parla\Services;

use App\Modules\Parla\Repositories\ComissaoRepository;
use Illuminate\Http\Request;
use Exception;
use DB;

class ComissaoService {
	protected $comissaoRepository;
	protected $comissaoSenadoWsService;
	protected $comissaoCamaraWsService;
	protected $parlamentarService;

	public function __construct(ComissaoRepository $comissaoRepository, ComissaoCamaraWsService $comissaoCamaraWsService, ComissaoSenadoWsService $comissaoSenadoWsService, ParlamentarService $parlamentarService) {
		$this->comissaoRepository = $comissaoRepository;
		$this->comissaoCamaraWsService = $comissaoCamaraWsService;
		$this->comissaoSenadoWsService = $comissaoSenadoWsService;
		$this->parlamentarService = $parlamentarService;
	}

	public function store() {
		$comissoesCD = array();
		$comissoesSF = array();

		$comissoesCD = $this->comissaoCamaraWsService->all();
		$comissoesSF = $this->comissaoSenadoWsService->all();
		
		try {
			$this->comissaoRepository->destroyComissoes(array_merge($comissoesCD,$comissoesSF));

			if ($comissoesCD){
				foreach ($comissoesCD as $comissaoCD) {
					$comissao =  $this->comissaoRepository->firstOrCreate($comissaoCD);
					$membros = $this->comissaoCamaraWsService->obterMembros($comissao);

					$membrosId = array();

					foreach ($membros as $membro) {
						if($membroBD = $comissao->membros->find($membro['id_parlamentar'])) {
							$membrosId[$membro['id_parlamentar']] = ['in_cargo' => $membro['in_cargo'],'in_posicionamento_comissao' => $membroBD->pivot->in_posicionamento_comissao];
						}
						else {
							$membrosId[$membro['id_parlamentar']] = ['in_cargo' => $membro['in_cargo']];
						}
					}

					$this->comissaoRepository->syncMembros($comissao,$membrosId);
				}	
			}

			if ($comissoesSF){
				foreach ($comissoesSF as $comissaoSF) {
					$comissao = $this->comissaoRepository->firstOrCreate($comissaoSF);
					$membros = $this->comissaoSenadoWsService->obterMembros($comissao);

					$membrosId = array();

					foreach ($membros as $membro) {
						if($membroBD = $comissao->membros->find($membro['id_parlamentar'])) {
							$membrosId[$membro['id_parlamentar']] = ['in_cargo' => $membro['in_cargo'],'in_posicionamento_comissao' => $membroBD->pivot->in_posicionamento_comissao];
						}
						else {
							$membrosId[$membro['id_parlamentar']] = ['in_cargo' => $membro['in_cargo']];
						}
					}

					$this->comissaoRepository->syncMembros($comissao,$membrosId);
				}	
			}

		} catch(\Exception $e) {
			
			throw new \Exception('Erro ao realizar o cadastro de Comissoes ('. $e->getMessage() .')');

		}
	}

	/**
	 * Método responsável por envior mensagem de erro aos responsáveis pelo Parla, no processo de inclusão/atualização da Comissao
	 *
	 * @param String $erro
	 * @param String $origemErro
	 */
	public function envioEmailErro($erro, $origemErro){
		
		Mail::send('parla::layouts.emails.email-aviso-erro-atualizacao-proposicao', 
			[
				'origemErro' => $origemErro,
				'erro' => $erro,
			], 
			function($message){
				$message->subject('Erro ao Atualizar Comissões do PARLA');
				$message->from('parla@fazenda.gov.br', 'Portal de Sistemas - PARLA');
				$message->to("luisa.palmeira@fazenda.gov.br");

			});

	}
}