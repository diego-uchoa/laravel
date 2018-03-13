<?php
namespace App\Modules\Gescon\Services;

use Illuminate\Support\Collection;
use App\Modules\Gescon\Repositories\ContratoRepository;
use App\Modules\Gescon\Repositories\ContratadaRepository;
use App\Modules\Gescon\Repositories\FiscalRepository;
use App\Modules\Gescon\Repositories\ContratoFiscalRepository;
use App\Modules\Gescon\Repositories\ContratoProcessoPagamentoRepository;
use App\Modules\Gescon\Repositories\ContratoInformacaoAdicionalRepository;
use App\Modules\Gescon\Repositories\ContratoPrepostoRepository;
use App\Http\Upload;
use MaskHelper;
use DB;
use Exception;

class ContratoService
{
	private $contratoRepository;
	private $contratanteRepository;
	private $contratadaRepository;
	private $fiscalRepository;
	private $contratoFiscalRepository;
	private $contratoProcessoPagamentoRepository;
	private $contratoInformacaoAdicionalRepository;
	private $contratoPrepostoRepository;
	
	public function __construct()
    {
        $this->contratoRepository = \App::make('App\Modules\Gescon\Repositories\ContratoRepository');
        $this->contratanteRepository = \App::make('App\Modules\Gescon\Repositories\ContratanteRepository');
        $this->contratadaRepository = \App::make('App\Modules\Gescon\Repositories\ContratadaRepository');
        $this->fiscalRepository = \App::make('App\Modules\Gescon\Repositories\FiscalRepository');
        $this->contratoFiscalRepository = \App::make('App\Modules\Gescon\Repositories\ContratoFiscalRepository');
        $this->contratoProcessoPagamentoRepository = \App::make('App\Modules\Gescon\Repositories\ContratoProcessoPagamentoRepository');
        $this->contratoInformacaoAdicionalRepository = \App::make('App\Modules\Gescon\Repositories\ContratoInformacaoAdicionalRepository');
        $this->contratoPrepostoRepository = \App::make('App\Modules\Gescon\Repositories\ContratoPrepostoRepository');
    }

	/**
	* Responsável por gravar dados do Contrato
	* @param  Request request
	*/
	protected function storeContrato($request)
	{
		try{

			$request = $this->__uploadFileModalidade($request);		
			$request = $this->__uploadFileContrato($request);		
			$request = $this->__uploadFileAta($request);		

			$dadosContrato = $this->__verificaContratada($request);
			$contrato = $this->contratoRepository->create($this->__preparaDadosContrato($dadosContrato));
			
			$this->__associarPrepostoContrato($contrato->id_contrato, $request);
			$this->__associarProcessosPagamentoContrato($contrato->id_contrato, $request);
			$this->__associarFiscalContrato($contrato->id_contrato, $request);
			$this->__associarInformacaoAdicionalContrato($contrato->id_contrato, $request);

			return $contrato;

		}catch (Exception $e){

			throw new Exception($e->getMessage());

		}
		
	}

	/**
	* Responsável por atualizar os dados básicos do Contrato
	* @param  Request request
	*/
	protected function updateContrato($request, $id_contrato)
	{
		try{

			$request = $this->__uploadFileModalidade($request);		
			$request = $this->__uploadFileContrato($request);		
			$request = $this->__uploadFileAta($request);		
			
			$dadosContrato = $this->__verificaContratada($request);
			$this->contratoRepository->update($this->__preparaDadosContrato($dadosContrato), $id_contrato);
			
			$this->__associarPrepostoContrato($id_contrato, $request);
			$this->__associarProcessosPagamentoContrato($id_contrato, $request);
			$this->__associarFiscalContrato($id_contrato, $request);
			$this->__associarInformacaoAdicionalContrato($id_contrato, $request);

			$contrato = $this->contratoRepository->find($id_contrato);

			return $contrato;

		}catch (Exception $e){

			throw new Exception($e->getMessage());

		}
		
	}

	/**
	* Responsável por gravar gravar o arquivo de Modalidade na pasta do GESCON
	* @param  Array $dados
	*/
	protected function __uploadFileModalidade($dados)
	{
		$pasta = "arquivos_modalidade/" .$dados['co_uasg']. "/" .$dados['nr_contrato'];
		if (isset($dados['arquivo-modalidade'])){
		    $upload = Upload::uploadFile($dados['arquivo-modalidade'], 'public_GESCON', $pasta);
		    $dados['tx_arquivo_modalidade'] = $pasta . "/" . $upload['nome_arquivo'];
		}else{
			if (isset($dados['arquivo_modalidade_delete'])){
				if ($dados['arquivo_modalidade_delete'] == 'false'){
					$dados['tx_arquivo_modalidade'] = $dados['arquivo_modalidade_atual'];
				}else{
					$dados['tx_arquivo_modalidade'] = '';
				}	
			}else{
				$dados['tx_arquivo_modalidade'] = '';
			}
		}

		return $dados;
	}

	/**
	* Responsável por gravar gravar o arquivo de Contrato na pasta do GESCON
	* @param  Array $dados
	*/
	protected function __uploadFileContrato($dados)
	{
		$pasta = "arquivos_contrato/" .$dados['co_uasg']. "/" .$dados['nr_contrato'];
		if (isset($dados['arquivo-contrato'])){
		    $upload = Upload::uploadFile($dados['arquivo-contrato'],'public_GESCON',$pasta);
		    $dados['tx_arquivo_contrato'] = $pasta . "/" . $upload['nome_arquivo'];
		}else{
			if (isset($dados['arquivo_contrato_delete'])){
				if ($dados['arquivo_contrato_delete'] == 'false'){
					$dados['tx_arquivo_contrato'] = $dados['arquivo_contrato_atual'];
				}else{
					$dados['tx_arquivo_contrato'] = '';
				}
			}else{
				$dados['tx_arquivo_contrato'] = '';
			}
		}

		return $dados;
	}

	/**
	* Responsável por gravar gravar o arquivo de Ata na pasta do GESCON
	* @param  Array $dados
	*/
	protected function __uploadFileAta($dados)
	{
		$pasta = "arquivos_ata/" .$dados['co_uasg']. "/" .$dados['nr_contrato'];
		if (isset($dados['arquivo-ata'])){
		    $upload = Upload::uploadFile($dados['arquivo-ata'],'public_GESCON',$pasta);
		    $dados['tx_arquivo_ata'] = $pasta . "/" . $upload['nome_arquivo'];
		}else{
			if (isset($dados['arquivo_ata_delete'])){
				if ($dados['arquivo_ata_delete'] == 'false'){
					$dados['tx_arquivo_ata'] = $dados['arquivo_ata_atual'];
				}else{
					$dados['tx_arquivo_ata'] = '';
				}
			}else{
				$dados['tx_arquivo_ata'] = '';
			}
		}

		return $dados;
	}

	/**
	 * Desassociar o Preposto do Contrato
	 *
	 * @param  int $id_contrato_preposto
	 */
	public function disassociate_preposto($id_contrato_preposto)
	{
	    $this->contratoPrepostoRepository->find($id_contrato_preposto)->delete();
	}

	/**
	 * Desassociar o Processo de Pagamento do Contrato
	 *
	 * @param  int $id_contrato_item_contratacao_terceirizacao
	 */
	public function disassociate_processo_pagamento($id_contrato_item_contratacao_terceirizacao)
	{
	    $this->contratoProcessoPagamentoRepository->find($id_contrato_item_contratacao_terceirizacao)->delete();
	}

	/**
	 * Desassociar o Fiscal do Contrato
	 *
	 * @param  int $id_contrato_fiscal
	 */
	public function disassociate_fiscal($id_contrato_fiscal)
	{
	    $this->contratoFiscalRepository->find($id_contrato_fiscal)->delete();
	}

	/**
	 * Desassociar a Informação Adicional do Contrato
	 *
	 * @param  int $id_contrato_informacao_adicional
	 */
	public function disassociate_informacao_adicional($id_contrato_informacao_adicional)
	{
	    $this->contratoInformacaoAdicionalRepository->find($id_contrato_informacao_adicional)->delete();
	}

	/**
	 * Método responsável por verificar se o Contratada do Contrato já existe cadastrado, se não, ele cadastra
	 *
	 */
	public function __verificaContratada($dados)
	{
		if (!$dados['id_contratada']){

			$dadosContratada = $this->__preparaDadosContratada($dados);
			$contratada = $this->contratadaRepository->create($dadosContratada);			
			$dados['id_contratada'] = $contratada->id_contratada;

		}

		return $dados;
	}

	/**
	 * Método responsável por preparar os dados recebidos do formulário, referentes ao Contratada
	 *
	 */
	protected function __preparaDadosContratada($dados)
	{
	    $array_contratada = [];

	    $array_contratada['in_tipo_contratada'] = $dados['in_tipo_contratada'];
	    $array_contratada['nr_cpf_cnpj'] = $dados['nr_cpf_cnpj'];
	    $array_contratada['no_razao_social'] = $dados['no_razao_social'];
	    $array_contratada['ed_cep_logradouro'] = $dados['ed_cep_logradouro'];
	    $array_contratada['ed_logradouro'] = $dados['ed_logradouro'];
	    $array_contratada['ed_numero_logradouro'] = $dados['ed_numero_logradouro'];
	    $array_contratada['ed_complemento_logradouro'] = $dados['ed_complemento_logradouro'];
	    $array_contratada['ed_bairro_logradouro'] = $dados['ed_bairro_logradouro'];
	    $array_contratada['id_municipio_logradouro'] = $dados['id_municipio_logradouro'];
	    $array_contratada['no_representante'] = $dados['no_representante'];
	    $array_contratada['nr_telefone'] = $dados['nr_telefone'];
	    $array_contratada['ds_email'] = $dados['ds_email'];
	    
	    return $array_contratada;
	}

	/**
	 * Método responsável por preparar os dados recebidos do formulário a serem gravados no Contrato
	 *
	 */
	protected function __preparaDadosContrato($dados)
	{
	    $array_contrato = [];

	    $array_contrato['nr_contrato'] = $dados['nr_contrato'];
	    $array_contrato['co_uasg'] = $dados['co_uasg'];
	    $array_contrato['id_contratante'] = $dados['id_contratante'];
	    $array_contrato['id_contratante_representante'] = $dados['id_contratante_representante'];
	    $array_contrato['id_contratante_assinante'] = $dados['id_contratante_assinante'];
	    $array_contrato['in_tipo'] = $dados['in_tipo'];
	    $array_contrato['nr_modalidade'] = $dados['nr_modalidade'];
	    $array_contrato['id_modalidade'] = $dados['id_modalidade'];
	    $array_contrato['nr_processo'] = $dados['nr_processo'];
	    $array_contrato['nr_cronograma'] = $dados['nr_cronograma'];
	    $array_contrato['tx_arquivo_modalidade'] = $dados['tx_arquivo_modalidade'];
	    $array_contrato['tx_arquivo_contrato'] = $dados['tx_arquivo_contrato'];
	    $array_contrato['tx_arquivo_ata'] = $dados['tx_arquivo_ata'];
	    $array_contrato['id_contratada'] = $dados['id_contratada'];
	    $array_contrato['in_objeto'] = $dados['in_objeto'];
	    $array_contrato['ds_objeto'] = $dados['ds_objeto'];
	    $array_contrato['ds_informacao_complementar'] = $dados['ds_informacao_complementar'];
	    $array_contrato['vl_mensal'] = $dados['vl_mensal'];
	    $array_contrato['vl_anual'] = $dados['vl_anual'];
	    $array_contrato['vl_global'] = $dados['vl_global'];
	    $array_contrato['dt_assinatura'] = $dados['dt_assinatura'];
	    $array_contrato['dt_publicacao'] = $dados['dt_publicacao'];
	    $array_contrato['dt_inicio_servico'] = $dados['dt_inicio_servico'];
	    $array_contrato['dt_cessacao'] = $dados['dt_cessacao'];
	    $array_contrato['nr_ano_prorrogacao'] = $dados['nr_ano_prorrogacao'];
	    $array_contrato['dt_prorrogacao'] = $dados['dt_prorrogacao'];
	    $array_contrato['in_tipo_variacao'] = $dados['in_tipo_variacao'];
	    $array_contrato['id_indice_variacao'] = $dados['id_indice_variacao'];
	    $array_contrato['in_modalidade_garantia'] = $dados['in_modalidade_garantia'];
	    $array_contrato['vl_garantia'] = $dados['vl_garantia'];
	    $array_contrato['op_percentual_garantia'] = $dados['op_percentual_garantia'];
	    $array_contrato['dt_vencimento_garantia'] = $dados['dt_vencimento_garantia'];

	    return $array_contrato;
	}

	/**
	 * Método responsável por associar os Prepostos do Contrato
	 *
	 */
	protected function __associarPrepostoContrato($id_contrato, $dados)
	{
		if (isset($dados['no_preposto_selecionada'])){
			$qtd_array = count($dados['no_preposto_selecionada']);

			for ($i = 0; $i < $qtd_array; $i++){
				
				if ($dados['st_preposto_novo'][$i] == "S"){
					$this->contratoPrepostoRepository->create($this->__preparaDadosPrepostoContrato($id_contrato, $dados, $i));
				}
			}		
		}
	}

	/**
	 * Método responsável por preparar os dados recebidos dos Prepostos que serão associados ao Contrato
	 *
	 */
	protected function __preparaDadosPrepostoContrato($id_contrato, $dados, $indice)
	{
		$array_preposto_contrato = [];

		$array_preposto_contrato['id_contrato'] = $id_contrato;
		$array_preposto_contrato['no_preposto'] = $dados['no_preposto_selecionada'][$indice];
		$array_preposto_contrato['nr_telefone_preposto'] = $dados['nr_telefone_preposto_selecionada'][$indice];
		$array_preposto_contrato['ds_email_preposto'] = $dados['ds_email_preposto_selecionada'][$indice];
		
		return $array_preposto_contrato;
	}

	/**
	 * Método responsável por associar os Itens de Contratação
	 *
	 */
	protected function __associarProcessosPagamentoContrato($id_contrato, $dados)
	{
		if (isset($dados['nr_nota_empenho_selecionada'])){
			$qtd_array = count($dados['nr_nota_empenho_selecionada']);

			for ($i = 0; $i < $qtd_array; $i++){
				
				if ($dados['st_processo_pagamanento_novo'][$i] == "S"){
					$this->contratoProcessoPagamentoRepository->create($this->__preparaDadosProcessoPagamentoContrato($id_contrato, $dados, $i));
				}
			}
		}
	}

	/**
	 * Método responsável por preparar os dados recebidos dos Processos de Pagamento de Contratação que serão associados ao Contrato
	 *
	 */
	protected function __preparaDadosProcessoPagamentoContrato($id_contrato, $dados, $indice)
	{
		$array_processo_pagamento_contrato = [];

		$array_processo_pagamento_contrato['id_contrato'] = $id_contrato;
		$array_processo_pagamento_contrato['nr_nota_empenho'] = $dados['nr_nota_empenho_selecionada'][$indice];
		$array_processo_pagamento_contrato['in_tipo'] = $dados['tp_nota_empenho_selecionada'][$indice];
		$array_processo_pagamento_contrato['nr_plano_interno'] = $dados['nr_plano_interno_selecionada'][$indice];
		$array_processo_pagamento_contrato['nr_elemento_despesa'] = $dados['nr_elemento_despesa_selecionada'][$indice];
		
		return $array_processo_pagamento_contrato;
	}

	/**
	 * Método responsável por associar os Fiscais do Contrato
	 *
	 */
	protected function __associarFiscalContrato($id_contrato, $dados)
	{
		if (isset($dados['nr_cpf_titular_selecionado'])){
			$qtd_array = count($dados['nr_cpf_titular_selecionado']);

			for ($i = 0; $i < $qtd_array; $i++){
				
				if ($dados['st_fiscal_novo'][$i] == "S"){
					if ($dados['id_titular_selecionado'][$i] == ""){

						$fiscal_BD = $this->fiscalRepository->findByCPF(MaskHelper::removeMascaraCpf($dados['nr_cpf_titular_selecionado'][$i]));
						if ($fiscal_BD){
							$dados['id_titular_selecionado'][$i] = $fiscal_BD->id_fiscal;	
						}else{
							$fiscal = $this->fiscalRepository->create($this->__preparaDadosFiscalTitular($dados, $i));
							$dados['id_titular_selecionado'][$i] = $fiscal->id_fiscal;	
						}
						
					}

					if ($dados['id_substituto_selecionado'][$i] == ""){

						if ($dados['nr_cpf_substituto_selecionado'][$i] != ""){
							$fiscal_BD = $this->fiscalRepository->findByCPF(MaskHelper::removeMascaraCpf($dados['nr_cpf_substituto_selecionado'][$i]));
							if ($fiscal_BD){
								$dados['id_substituto_selecionado'][$i] = $fiscal_BD->id_fiscal;	
							}else{
								$fiscal = $this->fiscalRepository->create($this->__preparaDadosFiscalSubstituto($dados, $i));
								$dados['id_substituto_selecionado'][$i] = $fiscal->id_fiscal;	
							}	
						}
						
					}

					$this->contratoFiscalRepository->create($this->__preparaDadosFiscalContrato($id_contrato, $dados, $i));	
					if ($dados['arquivo_ebps_selecionado'][$i] != ""){
						$this->__uploadFileFiscalEbps($dados, $i);	
					}

				}

			}
		}
	}

	/**
	* Responsável por mover os arquivos de e-BPS Fiscal da pasta Temp para a pasta correta
	* @param  Array $dados
	*/
	protected function __uploadFileFiscalEbps($dados, $indice)
	{
		$caminhoDestino = "arquivos_ebps/" .$dados['co_uasg']. "/" .$dados['nr_contrato']. "/";
		$caminhoTemporario = "arquivos_tmp/";
		$nomeArquivo = $dados['arquivo_ebps_selecionado'][$indice];

		Upload::moveFile($caminhoTemporario, 'public_GESCON', $caminhoDestino, $nomeArquivo);
	}

	/**
	 * Método responsável por preparar os dados recebidos dos fiscais que serão associados ao Contrato
	 *
	 */
	protected function __preparaDadosFiscalContrato($id_contrato, $dados, $indice)
	{
		$caminhoDestino = "arquivos_ebps/" .$dados['co_uasg']. "/" .$dados['nr_contrato']. "/";
		$array_fiscal_contrato = [];

		$array_fiscal_contrato['id_contrato'] = $id_contrato;
		$array_fiscal_contrato['id_fiscal_titular'] = $dados['id_titular_selecionado'][$indice];
		$array_fiscal_contrato['id_fiscal_substituto'] = $dados['id_substituto_selecionado'][$indice];
		$array_fiscal_contrato['in_tipo'] = $dados['in_tipo_fiscal_selecionado'][$indice];
		$array_fiscal_contrato['nr_portaria'] = $dados['nr_portaria_selecionado'][$indice];
		$array_fiscal_contrato['dt_execucao'] = $dados['dt_inicio_fiscal_selecionado'][$indice];
		$array_fiscal_contrato['nr_boletim'] = $dados['nr_boletim_selecionado'][$indice];
		if ($dados['arquivo_ebps_selecionado'][$indice] != ""){
			$array_fiscal_contrato['tx_arquivo_ebps'] = $caminhoDestino . $dados['arquivo_ebps_selecionado'][$indice];	
		}else{
			$array_fiscal_contrato['tx_arquivo_ebps'] = "";
		}
				
		return $array_fiscal_contrato;
	}

	/**
	 * Método responsável por preparar os dados recebidos do formulário, referentes ao Fiscal Titular
	 *
	 */
	protected function __preparaDadosFiscalTitular($dados, $indice)
	{
		$array_fiscal = [];

		$array_fiscal['nr_cpf'] = $dados['nr_cpf_titular_selecionado'][$indice];
		$array_fiscal['no_fiscal'] = $dados['no_titular_selecionado'][$indice];
		$array_fiscal['nr_siape'] = $dados['nr_matricula_titular_selecionado'][$indice];
		$array_fiscal['ds_email'] = $dados['ds_email_titular_selecionado'][$indice];
		$array_fiscal['nr_telefone'] = $dados['nr_telefone_titular_selecionado'][$indice];
		
		return $array_fiscal;
	}

	/**
	 * Método responsável por preparar os dados recebidos do formulário, referentes ao Fiscal Substituto
	 *
	 */
	protected function __preparaDadosFiscalSubstituto($dados, $indice)
	{
		$array_fiscal = [];

		$array_fiscal['nr_cpf'] = $dados['nr_cpf_substituto_selecionado'][$indice];
		$array_fiscal['no_fiscal'] = $dados['no_substituto_selecionado'][$indice];
		$array_fiscal['nr_siape'] = $dados['nr_matricula_substituto_selecionado'][$indice];
		$array_fiscal['ds_email'] = $dados['ds_email_substituto_selecionado'][$indice];
		$array_fiscal['nr_telefone'] = $dados['nr_telefone_substituto_selecionado'][$indice];
		
		return $array_fiscal;
	}

	/**
	 * Método responsável por associar as Informações Adicionais
	 *
	 */
	protected function __associarInformacaoAdicionalContrato($id_contrato, $dados)
	{
		if (isset($dados['id_informacao_adicionada'])){
			$qtd_array = count($dados['id_informacao_adicionada']);

			for ($i = 0; $i < $qtd_array; $i++){
				
				if ($dados['st_informacao_novo'][$i] == "S"){
					$this->contratoInformacaoAdicionalRepository->create($this->__preparaDadosInformacaoAdicionalContrato($id_contrato, $dados, $i));
				}
			}		
		}
	}

	/**
	 * Método responsável por preparar os dados recebidos das Informações Adicionais que serão associados ao Contrato
	 *
	 */
	protected function __preparaDadosInformacaoAdicionalContrato($id_contrato, $dados, $indice)
	{
		$array_informacao_adicional_contrato = [];

		$array_informacao_adicional_contrato['id_contrato'] = $id_contrato;
		$array_informacao_adicional_contrato['id_campo_informacao_adicional'] = $dados['id_informacao_adicionada'][$indice];
		$array_informacao_adicional_contrato['ds_campo_informacao_adicional'] = $dados['ds_informacao_adicionada'][$indice];
		
		return $array_informacao_adicional_contrato;
	}

}