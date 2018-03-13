<?php

namespace App\Modules\Prisma\Repositories;

use App\Modules\Prisma\Models\InstituicaoResponsavelPrevisao;
use App\Repositories\AbstractRepository;

class InstituicaoResponsavelPrevisaoRepository extends AbstractRepository
{
    public function __construct(InstituicaoResponsavelPrevisao $model)
    {
        $this->model = $model;
    }

    /**
     * Método responsável por retornar todas as Instituições Responsáveis por Previsão que não estejam associadas as Instituições cadastradas
     * 
     * @return Array $resultado
     */    
    public function listaTodosSemVinculo()
    {    
    	$listaInstituicoes = [];
    	$listaInstituicoes = [null => 'SELECIONE...'];
    	$lista = InstituicaoResponsavelPrevisao::doesntHave('instituicao')->get();
    	foreach ($lista as $instituicao) {
    		$listaInstituicoes += [$instituicao->id_instituicao_responsavel_previsao => $instituicao->no_instituicao_responsavel_previsao];
    	}
    	return $listaInstituicoes;
    }
}
