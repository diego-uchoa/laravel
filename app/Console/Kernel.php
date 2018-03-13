<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //SISCONTRATOS
        //\App\Modules\Siscontratos\Console\Commands\SendEmails::class,
        //\App\Modules\Siscontratos\Console\Commands\ChangeStatus::class,
        
        //SISADM
        \App\Modules\Sisadm\Console\Commands\DeleteAvatar::class,

        //PARLA
        \App\Modules\Parla\Console\Commands\AtualizaProposicaoParla::class,
        \App\Modules\Parla\Console\Commands\AtualizaComissaoParla::class,
        \App\Modules\Parla\Console\Commands\ExcluiRelatorioParla::class,

        //GESCON
        \App\Modules\Gescon\Console\Commands\MensageriaContratoGescon::class,
        \App\Modules\Gescon\Console\Commands\DeleteArquivoContrato::class

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // SISCONTRATOS
        //$schedule->command('siscontratos:status:change')->dailyAt('07:00');
        //$schedule->command('siscontratos:email:send')->cron('0 0 */3 * *');
        
        //SISADM - CADASTRO DE FOTO (USUARIO)
        $schedule->command('sisadm:delete:avatar')->dailyAt('04:00');

        //PARLA - ATUALIZAÇÃO DE PROPOSIÇÕES
        $schedule->command('parla:atualiza:proposicao')->everyMinute();    

        //PARLA - ATUALIZAÇÃO DE COMISSÕES
        $schedule->command('parla:atualiza:comissao')->weekly()->saturdays()->at('01:00');    

        //PARLA - EXCLUI RELATÓRIOS
        $schedule->command('parla:exclui:relatorio')->daily();

        //GESCON - VERIFICAR CONTRATOS A VENCER
        $schedule->command('gescon:mensageria:contratos')->daily();

        //GESCON - VERIFICAR OS ARQUIVOS NÃO VINCULADOS A CONTRATO PARA EXCLUÍ-LOS
        $schedule->command('gescon:delete:arquivo:contrato')->dailyAt('05:00');
        
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
