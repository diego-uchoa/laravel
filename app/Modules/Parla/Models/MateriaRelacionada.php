<?php

namespace App\Modules\Parla\Models;

use App\Models\AuditModel;

class MateriaRelacionada extends AuditModel
{

    protected $table = 'spoa_portal_parla.materia_relacionada';
    protected $primaryKey = 'id_materia_relacionada';

    protected $fillable = [
        'id_proposicao',
        'sg_casa_materia',
        'no_nome_materia',
        'tx_link_materia',
        'tx_observacao'
    ];

    protected $touches = ['proposicao'];

    public function proposicao() {
        return $this->belongsTo('App\Modules\Parla\Models\Proposicao','id_proposicao','id_proposicao');
    }
}