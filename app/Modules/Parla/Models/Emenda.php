<?php

namespace App\Modules\Parla\Models;

use App\Models\AuditModel;
use Carbon\Carbon;

class Emenda extends AuditModel
{

    protected $table = 'spoa_portal_parla.emenda';
    protected $primaryKey = 'id_emenda';

    protected $fillable = [
        'id_proposicao',
        'co_codigo_emenda',
        'sg_casa_emenda',
        'no_nome_emenda',
        'tx_link_emenda',
    ];

    protected $touches = ['proposicao'];

    public function proposicao() {
        return $this->belongsTo('App\Modules\Parla\Models\Proposicao','id_proposicao','id_proposicao');
    }
}