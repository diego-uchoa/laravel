<?php

namespace App\Modules\Parla\Models;

use App\Models\AuditModel;

class Apensado extends AuditModel
{

    protected $table = 'spoa_portal_parla.apensado';
    protected $primaryKey = 'id_apensado';

    protected $fillable = [
        'id_proposicao',
        'sg_casa_apensado',
        'no_nome_apensado',
        'tx_link_apensado',
        'tx_observacao'
    ];

    protected $touches = ['proposicao'];

    public function proposicao() {
        return $this->belongsTo('App\Modules\Parla\Models\Proposicao','id_proposicao','id_proposicao');
    }
}