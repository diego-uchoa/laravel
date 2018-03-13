<?php
namespace App\Modules\Gescon\Services;

use Illuminate\Support\Collection;
use App\Modules\Gescon\Repositories\ContratoItemContratacaoTerceirizacaoRepository;
use DB;
use Exception;

class ContratoTerceirizacaoService extends ContratoService
{
	private $contratoItemContratacaoTerceirizacaoRepository;
	
	public function __construct(ContratoItemContratacaoTerceirizacaoRepository $contratoItemContratacaoTerceirizacaoRepository)
    {
        $this->contratoItemContratacaoTerceirizacaoRepository = $contratoItemContratacaoTerceirizacaoRepository;
        parent::__construct();
    }

	/**
	* Responsável por gravar dados do Contrato
	* @param  Request request
	*/
	public function storeContrato($request)
	{
		try{	
			DB::beginTransaction();	
				$contrato = parent::storeContrato($request);
				$this->__associarItensContratacaoContrato($contrato, $request);
			DB::commit();	

	    }catch(Exception $e){

	    	DB::rollBack();
	    	throw new Exception($e->getMessage(), 999); 

	    }

	}

	/**
	* Responsável por atualizar dados do Contrato
	* @param  Request request
	*/
	public function updateContrato($request, $id_contrato)
	{
		try{	
			DB::beginTransaction();	
				$contrato = parent::updateContrato($request, $id_contrato);
				$this->__associarItensContratacaoContrato($contrato, $request);
			DB::commit();	

	    }catch(Exception $e){

	    	DB::rollBack();
	    	throw new Exception($e->getMessage(), 999); 

	    }

	}

	/**
	 * Excluir Itens de Contratação do Contrato
	 *
	 * @param  int $id_contrato_item_contratacao_terceirizacao
	 *
	 * @return Response
	 */
	public function destroy_item_contratacao($id_contrato_item_contratacao_terceirizacao)
	{
	    $this->contratoItemContratacaoTerceirizacaoRepository->find($id_contrato_item_contratacao_terceirizacao)->delete();
	}

	/**
	 * Método responsável por associar os Itens de Contratação
	 *
	 */
	private function __associarItensContratacaoContrato($contrato, $dados)
	{
		if (isset($dados['id_unidade_atendida_adicionada'])){
			$qtd_array = count($dados['id_unidade_atendida_adicionada']);

			for ($i = 0; $i < $qtd_array; $i++){
				
				if ($dados['st_item_contratacao_novo'][$i] == "S"){
					$this->contratoItemContratacaoTerceirizacaoRepository->create($this->__preparaDadosItemContratacaoContrato($contrato->id_contrato, $dados, $i));
				}
			}
		}
	}

	/**
	 * Método responsável por preparar os dados recebidos dos Itens de Contratação que serão associados ao Contrato
	 *
	 */
	private function __preparaDadosItemContratacaoContrato($id_contrato, $dados, $indice)
	{
		$array_item_contratacao_contrato = [];

		$array_item_contratacao_contrato['id_contrato'] = $id_contrato;
		$array_item_contratacao_contrato['id_orgao'] = $dados['id_unidade_atendida_adicionada'][$indice];
		$array_item_contratacao_contrato['id_edificio'] = $dados['id_edificio_atendido_adicionada'][$indice];
		$array_item_contratacao_contrato['id_tipo_item_contratacao'] = $dados['id_tipo_item_adicionada'][$indice];
		$array_item_contratacao_contrato['qt_item_contratacao'] = $dados['qt_item_contratacao_adicionada'][$indice];
		$array_item_contratacao_contrato['id_unidade_medida_item_contratacao'] = $dados['id_unidade_medida_item_contratacao_adicionada'][$indice];
		$array_item_contratacao_contrato['vl_item_contratacao'] = $dados['vl_item_contratacao_adicionada'][$indice];
		
		return $array_item_contratacao_contrato;
	}

}