<?php

namespace App\Modules\Parla\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class ExcluiRelatorioParla extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parla:exclui:relatorio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove os arquivos de relatórios de Consultas gerados.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = public_path().'/uploads/parla/relatorios/';
        \File::deleteDirectory($path.'pdf',true);
        \File::deleteDirectory($path.'xls',true);
    }
}
