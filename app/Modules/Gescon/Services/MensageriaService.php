<?php
namespace App\Modules\Gescon\Services;

use Illuminate\Support\Collection;
use App\Modules\Gescon\Repositories\ContratoRepository;
use App\Modules\Gescon\Repositories\ContratadaRepository;
use App\Modules\Gescon\Repositories\FiscalRepository;
use Exception;

use Carbon\Carbon;
use Mail;

class MensageriaService
{
	private $contratoRepository;
	private $contratadaRepository;
	private $fiscalRepository;
	
	public function __construct(ContratoRepository $contratoRepository,
	                                ContratadaRepository $contratadaRepository,
	                                FiscalRepository $fiscalRepository)
    {
        $this->contratoRepository = $contratoRepository;
        $this->contratadaRepository = $contratadaRepository;
        $this->fiscalRepository = $fiscalRepository;
    }


	/**
	* Método responsável por verificar os contratos a vencer no período de 180 dias e notificar por email os fiscais
	* quando o prazo para o vencimento for 15,30,60,90,120,180 dias.
	*
	*/
	public function contratosAvencer()
	{
		try{

			$prazoNotificado = [15,30,60,90,120,180];	

			$dataInicio = Carbon::now();
			$dataFim = $dataInicio->copy()->addDays(180);

			$contratosAvencer = $this->contratoRepository->filterPeriodoDtCessacao($dataInicio,$dataFim);
			foreach ($contratosAvencer as $contrato) {

				$dataCessacao = Carbon::createFromFormat('d/m/Y', $contrato->dt_cessacao);
				$prazoVencimento = $dataInicio->copy()->diffInDays($dataCessacao);

				if(in_array($prazoVencimento,$prazoNotificado)) {

					if (isset($contrato->fiscais)) {

						foreach( $contrato->fiscais as $fiscal) {

							$this->_enviarEmail($contrato, $fiscal->fiscalTitular, $prazoVencimento);

						}
						
						if (isset($fiscais->fiscalSubstituto)) {

							$this->_enviarEmail($contrato, $fiscais->fiscalSubstituto, $prazoVencimento);

						}
						
					}

				}
				
			}
			
	    }catch(Exception $e){

	        throw new \Exception('Erro mensageria contratos a vencer. ('. $e->getMessage() .')');

	    }

	}


	/**
	* Funcionalidade responsável por enviar email ao fiscal do contrato
	* 
	*/
	private function _enviarEmail($contrato, $fiscal, $prazoVencimento)
	{
		$dataCessacao = Carbon::createFromFormat('d/m/Y', $contrato->dt_cessacao);
		
	    Mail::send('gescon::layouts.emails.email-contrato-a-vencer', 
	        [
	            'fiscal_nome' => $fiscal->no_fiscal,
	            'contrato_nr_contrato' => $contrato->nr_contrato,
	            'contrato_prazo_vencimento' => $prazoVencimento,
	            'contrato_dt_cessacao' => $dataCessacao->format('d/m/Y'),
	            'contrato_objeto' => $contrato->ds_objeto,
	            'contrato_vl_anual' => $contrato->vl_anual,
	            'contrato_vl_global' => $contrato->vl_global,
	            'contrato_modalidade' => $contrato->modalidade->no_modalidade,
	            'contratada_no_razao_social' => $contrato->contratada->no_razao_social,

	        ], 
	        function($message) use ($fiscal, $prazoVencimento){

	            $message->subject('Contrato a vencer em '.$prazoVencimento.' dias');
	            $message->from('portal@fazenda.gov.br', 'Portal de Sistemas - Gescon');
	            $message->to($fiscal->ds_email);

	        });

	}

	/**
	 * Método responsável por envior mensagem de erro aos responsáveis pelo Parla, no processo de inclusão/atualização da Comissao
	 *
	 * @param String $erro
	 * @param String $origemErro
	 */
	public function envioEmailErro($erro, $origemErro){
		
		Mail::send('gescon::layouts.emails.email-aviso-erro', 
			[
				'origemErro' => $origemErro,
				'erro' => $erro,
			], 
			function($message){
				$message->subject('Erro ao Notificar contratos a vencer');
				$message->from('portal@fazenda.gov.br', 'Portal de Sistemas - Gescon');
				$message->to("alan.melo@fazenda.gov.br");

			});

	}

}