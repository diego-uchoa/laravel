<?php

namespace App\Modules\Parla\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class AtualizaProposicaoParla extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parla:atualiza:proposicao';
    protected $proposicaoRepository;
    protected $proposicaoService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualizar Proposições ativas com as informações do WS da Camara e do Senado Federal.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->proposicaoRepository = resolve('App\Modules\Parla\Repositories\ProposicaoRepository');
        $this->proposicaoService = resolve('App\Modules\Parla\Services\ProposicaoService');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //RECUPERA TODAS AS PROPOSICOES ATIVAS, OU SEJA, COM O CAMPO 'DELETED_AT' VAZIO E COM A DATA DE ATUALIZAÇÃO MENOR QUE A DATA ATUAL
        $dataHoje = explode(" ", Carbon::today())[0];
        $orderBy = array(['id_proposicao', 'desc']);
        $proposicoes = $this->proposicaoRepository->findBy([['updated_at','<', $dataHoje]],null,$orderBy,3,null);

        foreach ($proposicoes as $proposicao) {

            $dadosProposicao = $this->proposicaoService->findDadosProposicaoWsBySiglaOrigem($proposicao->sg_casa_origem, $proposicao->sg_sigla_origem, $proposicao->nr_numero_origem, $proposicao->an_ano_origem);
            $dadosRevisora = $this->proposicaoService->findRevisoraByOrigem($dadosProposicao);
            
            try {

                DB::beginTransaction();

                    $this->proposicaoService->atualizaProposicao($dadosProposicao + $dadosRevisora, $proposicao);

                DB::commit();

            } catch(\Exception $e) {
             
                DB::rollBack();
                $this->proposicaoService->envioEmailErro($proposicao->nr_numero_origem, $proposicao->an_ano_origem, $proposicao->sg_casa_origem, $proposicao->sg_sigla_origem, $e->getMessage(), 'Atualização da Proposição por meio do método de Atualização Diária.');
            }
                
        }
    }
}
