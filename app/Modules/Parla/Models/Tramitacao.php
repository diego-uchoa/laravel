<?php

namespace App\Modules\Parla\Models;

use App\Models\AuditModel;
use Carbon\Carbon;

class Tramitacao extends AuditModel
{

    protected $table = 'spoa_portal_parla.tramitacao';
    protected $primaryKey = 'id_tramitacao';

    protected $fillable = [
        'id_proposicao',
        'co_codigo_tramitacao',
        'sg_casa_tramitacao',
        'dt_data_tramitacao',
        'no_orgao_tramitacao',
        'tx_andamento',
        'tx_observacao'
    ];

    protected $touches = ['proposicao'];

    public function proposicao() {
        return $this->belongsTo('App\Modules\Parla\Models\Proposicao','id_proposicao','id_proposicao');
    }

    public function getDtDataTramitacaoAttribute() {
        if($this->attributes['dt_data_tramitacao']) {
            return Carbon::parse($this->attributes['dt_data_tramitacao'])->format('d/m/Y');
        }
    }
}