<?php

namespace App\Modules\Gescon\Console\Commands;

use Illuminate\Console\Command;
use Exception;

class MensageriaContratoGescon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gescon:mensageria:contratos';
    protected $mensageriaService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica os contratos a vencer no período de 180 dias e notifica por email os fiscais quando o prazo para o vencimento for 15,30,60,90,120,180 dias.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->mensageriaService = resolve('App\Modules\Gescon\Services\MensageriaService');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        try {
            $this->mensageriaService->contratosAvencer();
        } catch(Exception $e) {
            $this->mensageriaService->envioEmailErro($e->getMessage(), 'Erro envio notificação diária de contratos a vencer.');
        }
    }
}
