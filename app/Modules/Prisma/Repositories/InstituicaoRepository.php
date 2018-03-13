<?php

namespace App\Modules\Prisma\Repositories;

use App\Modules\Prisma\Models\Instituicao;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;

class InstituicaoRepository extends AbstractRepository
{
    public function __construct(Instituicao $model)
    {
        $this->model = $model;
    }

    /**
    * Retorna o Instituicao de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo SELECT2
    * @return Array
    */
    public function prepareListaSelect2()
    {
        $retorno_formatado = [];
        $retorno_formatado[] = ['text' => 'Selecione', 'id' => null];
        $instituicoes = $this->all();
        if ($instituicoes)
        {
            foreach ($instituicoes as $instituicao) {
                $retorno_formatado[] = ['text' => $instituicao->no_razao_social, 'id' => $instituicao->id_instituicao];
            }    
        }
        else
        {
            $retorno_formatado[] = ['text' => 'Selecione', 'id' => null];
        }

        return $retorno_formatado;  
    }

    public function prepareListaSelect2ByNome($parametro)
    {
        $insituicoes = [];    
        $insituicoes[] = ['text' => 'SELECIONE', 'id' => null];
        
        $instituicoes = $this->filterByNome($parametro);
            foreach ($instituicoes as $instituicao) {
                $insituicoes[] = ['text' => $instituicao->no_razao_social. " - ". $instituicao->no_relatorio, 'id' => $instituicao->id_instituicao];
            }
               
        return $insituicoes;        
    }

    /**
    * Retorna todos as Insituicoes que atendam o parametro informado
    * @param  String $instituicao
    * @return Orgao
    */
    public function filterByNome($instituicao)
    {
        $instituicoes = DB::table('spoa_portal_prisma_s1.instituicao')
                        ->where(DB::raw('remove_acento(upper(no_razao_social))'), 'like', '%'. strtoupper($instituicao) .'%')
                        ->orWhere(DB::raw('remove_acento(upper(no_relatorio))'), 'like', '%'. strtoupper($instituicao) .'%')
                        ->get();

        return $instituicoes;
    }



}
