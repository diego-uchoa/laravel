<?php

namespace App\Modules\Prisma\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Modules\Prisma\Services\CnpjWsService;
use App\Modules\Prisma\Services\SolicitacaoCadastroService;
use App\Modules\Prisma\Enum\SituacaoSolicitacao;
use App\Modules\Prisma\Repositories\SolicitacaoCadastroRepository;
use App\Modules\Prisma\Repositories\InstituicaoResponsavelPrevisaoRepository;
use App\Modules\Prisma\Http\Requests\SolicitacaoCadastroRequest;
use App\Modules\Prisma\Http\Requests\AprovarSolicitacaoCadastroRequest;
use App\Modules\Prisma\Http\Requests\RejeitarSolicitacaoCadastroRequest;

class SolicitacaoCadastroController extends Controller
{
	protected $cnpjWsService;
	protected $solicitacaoCadastroService;
	protected $solicitacaoCadastroRepository;

	public function __construct(CnpjWsService $cnpjWsService, 
		SolicitacaoCadastroService $solicitacaoCadastroService,
		SolicitacaoCadastroRepository $solicitacaoCadastroRepository,
		InstituicaoResponsavelPrevisaoRepository $instituicaoResponsavelPrevisaoRepository) {
		$this->cnpjWsService = $cnpjWsService;
		$this->solicitacaoCadastroService = $solicitacaoCadastroService;
		$this->solicitacaoCadastroRepository = $solicitacaoCadastroRepository;
		$this->instituicaoResponsavelPrevisaoRepository = $instituicaoResponsavelPrevisaoRepository;
	}

	public function index() {
		$solicitacoesCadastro = $this->solicitacaoCadastroRepository->all();
		return view('prisma::solicitacoes_cadastro.analise.index',compact('solicitacoesCadastro'));
	}

	public function create() {
		return view('prisma::solicitacoes_cadastro.solicitacoes.index');
	}

	public function edit($id) {
		$solicitacaoCadastro = $this->solicitacaoCadastroRepository->find($id);
		
		$instituicaoResponsavelPrevisao = $this->instituicaoResponsavelPrevisaoRepository->listaTodosSemVinculo();
		if ($solicitacaoCadastro->instituicaoPrevisao){
			$instituicaoResponsavelPrevisao += [$solicitacaoCadastro->instituicaoPrevisao->id_instituicao_responsavel_previsao => $solicitacaoCadastro->instituicaoPrevisao->no_instituicao_responsavel_previsao];
		}

		$situacao = SituacaoSolicitacao::getConstants();
		return view('prisma::solicitacoes_cadastro.analise.edit',compact('solicitacaoCadastro','situacao', 'instituicaoResponsavelPrevisao'));
	}

	/**
	* Método responsável por recuperar os dados da instituição no WS Receita
	* @param  String $cnpj
	* @return Array
	*/
	public function findDadosInstituicaoWsByCNPJ($cnpj)
	{
	    $dadosInstituicao = array();
	    $instituicaoWs = $this->cnpjWsService->findByCnpj($cnpj);

	    if($instituicaoWs->status == 'OK') {
	    	$dadosInstituicao['status'] = 'OK';
	    	$dadosInstituicao['no_razao_social'] = $instituicaoWs->nome;
	    	$dadosInstituicao['ed_logradouro'] = $instituicaoWs->logradouro;
	    	$dadosInstituicao['ed_numero_logradouro'] = $instituicaoWs->numero;
	    	$dadosInstituicao['ed_complemento_logradouro'] = $instituicaoWs->complemento;
	    	$dadosInstituicao['ed_bairro_logradouro'] = $instituicaoWs->bairro;
	    	$dadosInstituicao['ed_municipio_logradouro'] = $instituicaoWs->municipio;
	    	$dadosInstituicao['ed_sigla_uf'] = $instituicaoWs->uf;
	    	$dadosInstituicao['ed_cep_logradouro'] = $instituicaoWs->cep;
	    	$dadosInstituicao['nr_telefone'] = $instituicaoWs->telefone;
	    	$dadosInstituicao['ds_email'] = $instituicaoWs->email;
	    	$dadosInstituicao['no_situacao'] = $instituicaoWs->situacao;

	    }
	    else if($instituicaoWs->status == 'ERROR') {
	    	$dadosInstituicao['status'] = 'ERROR';
	    }

	    return $dadosInstituicao;
	}

	/**
	 * Método responsável por inserir dados solicitações de cadastro
	 *
	 */
	public function store(SolicitacaoCadastroRequest $request)
	{   
		
	    try{

	    	$this->solicitacaoCadastroService->store($request->all());

	        return response(['msg' => 'Solicitação de cadastro enviada com sucesso!', 'status' => 'success', 'redirect_url' => route('prisma::solicitacao.cadastro.confirmacao')]);

	    }catch (\Exception $e){
	        
	        return response(['msg' => 'Não foi possível realizar o cadastro da solicitação.', 'detail' => $e->getMessage(), 'status' => 'error']);

	    }

	}

	/**
	 * Atualiza um Solicitação de Cadastro
	 *
	 */
	public function update($id, Request $request)
	{
	    try{

	    	$request['in_situacao_solicitacao'] = "E";
	    	
	    	$this->solicitacaoCadastroRepository->update($request->all(), $id);

	    	return redirect()->route('prisma::solicitacao.cadastro.index')->with('message', trans('alerts.registro.updated'));    

	       
	    }catch(\Exception $e){
	                	
	    	$messagesExceptions = [
	    		'exception' => 'Erro '. $e->getCode() .' : ', 
	    		'message_exception' => $e->getMessage()
	    	];

	    	return redirect()->back()->with($messagesExceptions, $e->getCode());

	    }
	    
	}

	/**
	 * Método responsável por Aprovar uma Solicitação de Cadastro
	 *
	 */
	public function aprovar(AprovarSolicitacaoCadastroRequest $request)
	{
	    try{

	    	$solicitacaoCadastro = $this->solicitacaoCadastroRepository->find($request['id_solicitacao_cadastro']);
	    	
	    	$request['in_situacao_solicitacao'] = "A";

	    	$request['id_usuario_analise'] = \Auth::id();
	    	$request['dt_analise'] = date('Y-m-d H:i:s');

	    	$result = $this->solicitacaoCadastroService->aprovar($request->all(), $request['id_solicitacao_cadastro']);
    		
    		$this->solicitacaoCadastroService->_enviarEmailAprovada($solicitacaoCadastro);
    		
    		return view('prisma::solicitacoes_cadastro.analise.confirmacao', compact('result','solicitacaoCadastro'))->with('message', trans('alerts.registro.updated'));     
	       
	    }catch(\Exception $e){
	                
	    	$messagesExceptions = [
	    		'exception' => 'Erro '. $e->getCode() .' : ', 
	    		'message_exception' => $e->getMessage()
	    	];

	    	return redirect()->back()->with($messagesExceptions, $e->getCode());

	    }
	    
	}

	/**
	 * Método responsável por Rejeitar uma Solicitação de Cadastro
	 *
	 */
	public function rejeitar(RejeitarSolicitacaoCadastroRequest $request)
	{
	    try{

    		$request['in_situacao_solicitacao'] = "R";

    		$request['id_usuario_analise'] = \Auth::id();
    		$request['dt_analise'] = date('Y-m-d H:i:s');

    		$this->solicitacaoCadastroRepository->update($request->all(), $request['id_solicitacao_cadastro']);

    		$solicitacaoCadastro = $this->solicitacaoCadastroRepository->find($request['id_solicitacao_cadastro']);
    		
    		$this->solicitacaoCadastroService->_enviarEmailRecusada($solicitacaoCadastro);

    		$solicitacoesCadastro = $this->solicitacaoCadastroRepository->all();
    		
    		return redirect()->route('prisma::solicitacao.cadastro.index')->with('message', trans('alerts.registro.updated'));    
	       
	    }catch(\Exception $e){
	                
	    	$messagesExceptions = [
	    		'exception' => 'Erro '. $e->getCode() .' : ', 
	    		'message_exception' => $e->getMessage()
	    	];

	    	return redirect()->back()->with($messagesExceptions, $e->getCode());

	    }
	    
	}


	/**
	 * Gera a datatable de proposicoes
	 */
	public function list(Request $request)
	{
	    $solicitacoesCadastro = $this->solicitacaoCadastroRepository->all();
	    
	    return Datatables::of($solicitacoesCadastro)

	        ->addColumn('nr_cnpj', function ($solicitacoesCadastro) {
	        	return $solicitacoesCadastro->nr_cnpj;
	        })
	        ->addColumn('no_razao_social', function ($solicitacoesCadastro) {
	        	return $solicitacoesCadastro->no_razao_social;
	        })
	        ->addColumn('no_relatorio', function ($solicitacoesCadastro) {
	        	return $solicitacoesCadastro->no_relatorio;
	        })
	        ->addColumn('no_responsavel', function ($solicitacoesCadastro) {
	        	return $solicitacoesCadastro->no_responsavel;
	        })
	        ->addColumn('in_situacao', function ($solicitacoesCadastro) {
	        	return $solicitacoesCadastro->situacao();
	        })

	        ->addColumn('operacoes', function ($solicitacoesCadastro) {
	        	if($solicitacoesCadastro->in_situacao_solicitacao == 'A' || $solicitacoesCadastro->in_situacao_solicitacao == 'R') {
		        	return "<a href=".route('prisma::solicitacao.cadastro.edit',['id' => $solicitacoesCadastro->id_solicitacao_cadastro])." class='btn btn-xs btn-success' data-rel='tooltip' data-original-title='Visualizar dados da solicitação de cadastro. Não será possível alterar a situação da solicitação.'>
					        	<i class='ace-icon fa fa-eye'></i>
					        </a>";
				}
				else if($solicitacoesCadastro->in_situacao_solicitacao == 'E' || $solicitacoesCadastro->in_situacao_solicitacao == 'P') {
		        	return "<a href=".route('prisma::solicitacao.cadastro.edit',['id' => $solicitacoesCadastro->id_solicitacao_cadastro])." class='btn btn-xs btn-info' data-rel='tooltip' data-original-title='Analisar a solicitação de cadastro para aprovar ou rejeitar.'>
					        	<i class='ace-icon fa fa-pencil'></i>
					        </a>";
				}
		    })
	        ->rawColumns(['operacoes'])
	        ->make(true);
	}
	    
}