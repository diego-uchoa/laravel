<?php

namespace App\Modules\Parla\Repositories;

use App\Modules\Parla\Models\Comissao;
use App\Repositories\AbstractRepository;
use DB;

class ComissaoRepository extends AbstractRepository
{
    public function __construct(Comissao $model) {
        $this->model = $model;
    }

    public function syncMembros($comissao, $membros) {
        $membros = (array)$membros;
        return $comissao->membros()->sync($membros);
    }

    public function destroyComissoes($comissoes) {
        Comissao::whereNotNull('id_comissao')->delete();

        foreach ($comissoes as $comissao) {
            $newComissao = Comissao::where($comissao)->withTrashed()->first() ?: new Comissao($comissao);
            if ($newComissao->trashed()) { 
                $newComissao->restore();
            }
        }
    }

    public function preparaListaComissoes() {
        $listaComissoes  = array();

        $comissoes = $this->all();

        $listaComissoes[null] = 'Selecione ...';

        foreach ($comissoes as $comissao) {
            $listaComissoes[$comissao->sg_casa.' - '.$comissao->sg_comissao] = $comissao->sg_casa.' - '.$comissao->sg_comissao;
        }

        return $listaComissoes;        
    }
}
