<?php
namespace App\Modules\Prisma\Services;

use Illuminate\Support\Collection;
use App\Helpers\UtilHelper;
use MaskHelper;
use DB;
use Exception;
use Illuminate\Http\Request;
use Mail;

use App\Modules\Prisma\Repositories\SolicitacaoCadastroRepository;
use App\Modules\Prisma\Repositories\SolicitacaoCadastroEditorRepository;
use App\Modules\Sisadm\Repositories\PerfilRepository;


class SolicitacaoCadastroService
{

	protected $solicitacaoCadastroRepository;
	protected $solicitacaoCadastroEditorRepository;
	protected $perfilRepository;

	protected $instituicaoService;
	protected $controleUsuarioService;

	
	public function __construct(
		SolicitacaoCadastroRepository $solicitacaoCadastroRepository,
		SolicitacaoCadastroEditorRepository $solicitacaoCadastroEditorRepository,
		PerfilRepository $perfilRepository,
		InstituicaoService $instituicaoService,
		ControleUsuarioService $controleUsuarioService) {
		$this->solicitacaoCadastroRepository = $solicitacaoCadastroRepository;
		$this->solicitacaoCadastroEditorRepository = $solicitacaoCadastroEditorRepository;
		$this->perfilRepository = $perfilRepository;
		$this->instituicaoService = $instituicaoService;
		$this->controleUsuarioService = $controleUsuarioService;
	}


	/**
	 * Método responsável por inserir dados solicitações de cadastro
	 *@param  Request request
	 */
	public function store($request)
	{
		try{	

			DB::beginTransaction();	
				$request['in_situacao_solicitacao'] = 'P';
				$solicitacaoCadastro = $this->solicitacaoCadastroRepository->create($request);
				$this->__associarEditoresSolicitacaoCadastro($solicitacaoCadastro, $request);

				$perfilGestorSpe = $this->perfilRepository->findByName('PRISMA-Gestor');
				$usuariosGestoresSpe = $perfilGestorSpe->usuarios;

				foreach ($usuariosGestoresSpe as $usuario) {
					$this->_enviarEmailAlerta($usuario, $solicitacaoCadastro);
				}

			DB::commit();	

	    }catch(Exception $e){

	    	
	    	DB::rollBack();
	    	throw new Exception($e->getMessage(), 999); 

	    }

	}

	/**
	 * Método responsável por associar os Editores a Solicitação de Cadastro
	 *
	 */
	private function __associarEditoresSolicitacaoCadastro($solicitacaoCadastro, $dados)
	{
		if (isset($dados['nr_cpf_editor_adicionada'])){
			$qtd_array = count($dados['nr_cpf_editor_adicionada']);

			for ($i = 0; $i < $qtd_array; $i++){
				
				$this->solicitacaoCadastroEditorRepository->create($this->__preparaDadosEditor($solicitacaoCadastro->id_solicitacao_cadastro, $dados, $i));
				
			}
		}
	}

	/**
	 * Método responsável por preparar os dados recebidos dos Editores que serão associados a Solicitação de Cadastro
	 *
	 */
	private function __preparaDadosEditor($idSolicitacaoCadastro, $dados, $indice)
	{
		$array_item_editor = [];

		$array_item_editor['id_solicitacao_cadastro'] = $idSolicitacaoCadastro;
		$array_item_editor['nr_cpf'] = $dados['nr_cpf_editor_adicionada'][$indice];
		$array_item_editor['no_editor'] = $dados['no_editor_adicionada'][$indice];
		$array_item_editor['ds_email'] = $dados['ds_email_editor_adicionada'][$indice];
		$array_item_editor['nr_telefone'] = $dados['nr_telefone_editor_adicionada'][$indice];

		return $array_item_editor;
	}

	/**
	* Responsável por atualizar a solicitação de cadastro
	* @param  Request request
	*/
	public function aprovar($request, $id_contrato)
	{
		try{	
			DB::beginTransaction();	
				
				$this->solicitacaoCadastroRepository->update($request, $id_contrato);

				$solicitacaoCadastro = $this->solicitacaoCadastroRepository->find($id_contrato);
				
				//Cria Instituição
				$dadosInstituicao = array(
					'nr_cnpj' => $solicitacaoCadastro->nr_cnpj,
					'no_razao_social' => $solicitacaoCadastro->no_razao_social,
					'no_relatorio' => $solicitacaoCadastro->no_relatorio,
					'no_situacao' => $solicitacaoCadastro->no_situacao,
					'nr_telefone' => $solicitacaoCadastro->nr_telefone,
					'ds_email' => $solicitacaoCadastro->ds_email,
					'ed_cep_logradouro' => $solicitacaoCadastro->ed_cep_logradouro,
					'ed_logradouro' => $solicitacaoCadastro->ed_logradouro,
					'ed_numero_logradouro' => $solicitacaoCadastro->ed_numero_logradouro,
					'ed_complemento_logradouro' => $solicitacaoCadastro->ed_complemento_logradouro,
					'ed_bairro_logradouro' => $solicitacaoCadastro->ed_bairro_logradouro,
					'ed_municipio_logradouro' => $solicitacaoCadastro->ed_municipio_logradouro,
					'ed_sigla_uf' => $solicitacaoCadastro->ed_sigla_uf,
					'nr_cpf_responsavel' => MaskHelper::removeMascaraCpf($solicitacaoCadastro->nr_cpf_responsavel),
					'no_responsavel' => $solicitacaoCadastro->no_responsavel,
					'nr_telefone_responsavel' => $solicitacaoCadastro->nr_telefone_responsavel,
					'ds_email_responsavel' => $solicitacaoCadastro->ds_email_responsavel,
					'no_cargo_responsavel' => $solicitacaoCadastro->no_cargo_responsavel,
					'id_solicitacao_cadastro' => $solicitacaoCadastro->id_solicitacao_cadastro,
					'id_instituicao_responsavel_previsao' => $request['id_instituicao_responsavel_previsao'],
					'in_situacao' => 'A'
				);

				$instituicao = $this->instituicaoService->store($dadosInstituicao);

				//Criar Editores
				$editores = $solicitacaoCadastro->editores;
				$resultCadastroEditores = $this->_storeEditores($instituicao, $editores);

				//Criar Responsável
				$resultCadastroResponsavel = $this->_storeResponsavel($instituicao, $solicitacaoCadastro);		
				
			DB::commit();


			$result = [
			    'resultCadastroEditores' => $resultCadastroEditores,
			    'resultCadastroResponsavel' => $resultCadastroResponsavel
			];

			return $result;	

	    }catch(Exception $e){

	    	DB::rollBack();
	    	throw new Exception('Erro processo análise de solicitação de cadastro.'.$e->getMessage(), 999); 

	    }

	}

	/**
	* Funcionalidade responsável por gravar o usuário do tipo Responsável relacionado a Instituição
	*/
	private function _storeResponsavel($instituicao, $solicitacaoCadastro)
	{
		$resultCadastroResponsavel = new Collection;

		$responsavel = array(
			'nr_cpf' => $solicitacaoCadastro->nr_cpf_responsavel,
			'no_usuario' => $solicitacaoCadastro->no_responsavel,
			'email' => $solicitacaoCadastro->ds_email_responsavel,
			// 'email' => 'andre.boaro@fazenda.gov.br',
			'sn_externo' => true,
			'nr_telefone' => $solicitacaoCadastro->nr_telefone_responsavel,
			'in_perfil' => 'R',
			'no_cargo' => $solicitacaoCadastro->no_cargo_responsavel
		);

		$dadosResponsavel = new \Illuminate\Http\Request();
		$dadosResponsavel->replace($responsavel);
		$usuarioResponsavel = $this->controleUsuarioService->store($dadosResponsavel);

		//Associar Usuario a Instituicao/ incluir telefone
		$responsavelAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$dadosResponsavel);

		//Associar Perfil Responsavel
		$perfilResponsavel = $this->controleUsuarioService->associarPerfil($solicitacaoCadastro->nr_cpf_responsavel,'PRISMA-ResponsavelInstituicao');

		$resultCadastroResponsavel->push([
				'nr_cpf' => $solicitacaoCadastro->nr_cpf_responsavel,
				'no_usuario' => $solicitacaoCadastro->no_responsavel, 
				'result' => $usuarioResponsavel, 
				'result_associacao' => $responsavelAssociacao,
				'result_perfil' => $perfilResponsavel]);

		return $resultCadastroResponsavel;
	}

	/**
	* Funcionalidade responsável por gravar os usuários do tipo Editor relacionados a Instituição
	*/
	private function _storeEditores($instituicao, $editores)
	{
		$resultCadastroEditores = new Collection;

		foreach ($editores as $editor) {
			
			$editorUsuario = arraY(
				'nr_cpf' => $editor->nr_cpf,
				'no_usuario' => $editor->no_editor,
				'email' => $editor->ds_email,
				// 'email' => 'luisa.palmeira@fazenda.gov.br',
				'sn_externo' => true,
				'nr_telefone' => $editor->nr_telefone,
				'in_perfil' => 'E',
				'no_cargo' => null
			);

			$dadosEditor = new \Illuminate\Http\Request();
			$dadosEditor->replace($editorUsuario);
			$usuarioEditor = $this->controleUsuarioService->store($dadosEditor);

			//Associar Usuario a Instituicao/ incluir telefone
			$usuarioAssociacao = $this->controleUsuarioService->associarUsuarioInstituicao($instituicao,$dadosEditor);

			//Associar Perfil Editores
			$perfilEditor = $this->controleUsuarioService->associarPerfil($editor->nr_cpf,'PRISMA-EditorInstituicao');
			
			$resultCadastroEditores->push([
					'nr_cpf' => $editor->nr_cpf,
					'no_usuario' => $editor->no_editor, 
					'result' => $usuarioEditor, 
					'result_associacao' => $usuarioAssociacao,
					'result_perfil' => $perfilEditor]);
								

		}

		return $resultCadastroEditores;
	}

	/**
	* Funcionalidade responsável por enviar email aos gestores do sistema sobre nova solicitação* 
	*/
	private function _enviarEmailAlerta($user, $solicitacaoCadastro)
	{
	
		Mail::send('prisma::layouts.emails.email-solicitacao-cadastro-alerta', 
			[
			'cnpj' => $solicitacaoCadastro->nr_cnpj,
			'instituicao' => $solicitacaoCadastro->no_razao_social,
			'nome_relatorio' => $solicitacaoCadastro->no_relatorio,
			'nome_responsavel' => $solicitacaoCadastro->no_responsavel,
			'cpf' => $solicitacaoCadastro->nr_cpf_responsavel,
			
			], 
			function($message) use ($user){

				$message->subject('[PRISMA FISCAL] Nova solicitação de cadastro de instituição');
				$message->from('portal@fazenda.gov.br', 'Portal de Sistemas');
				$message->to($user->email);

			});
	}

	/**
	* Funcionalidade responsável por enviar email ao responsável pela instituição sobre a aprovação da solicitação 
	*/
	public function _enviarEmailAprovada($solicitacaoCadastro)
	{
	
		Mail::send('prisma::layouts.emails.email-solicitacao-cadastro-aprovada', 
			[
			'cnpj' => $solicitacaoCadastro->nr_cnpj,
			'instituicao' => $solicitacaoCadastro->no_razao_social,
			'nome_relatorio' => $solicitacaoCadastro->no_relatorio,
			'nome_responsavel' => $solicitacaoCadastro->no_responsavel,
			'cpf' => $solicitacaoCadastro->nr_cpf_responsavel,
			
			], 
			function($message) use ($solicitacaoCadastro){

				$message->subject('[PRISMA FISCAL] Solicitação de Cadastro de Instituição - Aprovada');
				$message->from('portal@fazenda.gov.br', 'Portal de Sistemas');
				$message->to($solicitacaoCadastro->ds_email_responsavel);

			});
	}


	/**
	* Funcionalidade responsável por enviar email ao responsável pela instituição sobre a recusa da solicitação 
	*/
	public function _enviarEmailRecusada($solicitacaoCadastro)
	{
	
		Mail::send('prisma::layouts.emails.email-solicitacao-cadastro-recusada', 
			[
			'cnpj' => $solicitacaoCadastro->nr_cnpj,
			'instituicao' => $solicitacaoCadastro->no_razao_social,
			'nome_relatorio' => $solicitacaoCadastro->no_relatorio,
			'nome_responsavel' => $solicitacaoCadastro->no_responsavel,
			'cpf' => $solicitacaoCadastro->nr_cpf_responsavel,
			'analise' => $solicitacaoCadastro->tx_analise,
			
			], 
			function($message) use ($solicitacaoCadastro){

				$message->subject('[PRISMA FISCAL] Solicitação de Cadastro de Instituição - Recusada');
				$message->from('portal@fazenda.gov.br', 'Portal de Sistemas');
				$message->to($solicitacaoCadastro->ds_email_responsavel);

			});
	}

	

}