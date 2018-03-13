<?php

namespace App\Modules\Parla\Models;

use App\Models\AuditModel;
use Carbon\Carbon;

class Substitutivo extends AuditModel
{

    protected $table = 'spoa_portal_parla.substitutivo';
    protected $primaryKey = 'id_substitutivo';

    protected $fillable = [
        'id_proposicao',
        'co_codigo_substitutivo',
        'sg_casa_substitutivo',
        'no_nome_substitutivo',
        'tx_link_substitutivo',
    ];

    protected $touches = ['proposicao'];

    public function proposicao() {
        return $this->belongsTo('App\Modules\Parla\Models\Proposicao','id_proposicao','id_proposicao');
    }
}