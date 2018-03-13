<?php

namespace App\Modules\Parla\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class AtualizaComissaoParla extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parla:atualiza:comissao';
    protected $comissaoService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualizar Comissões com as informações do WS da Camara e do Senado Federal.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->comissaoService = resolve('App\Modules\Parla\Services\ComissaoService');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        try {
            DB::beginTransaction();
                $this->comissaoService->store();
            DB::commit();

        } catch(Exception $e) {
            DB::rollBack();
            $this->comissaoService->envioEmailErro($e->getMessage(), 'Atualização das Comissões por meio do método de Atualização Diária.');
        }
    }
}
