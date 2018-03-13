<?php

namespace App\Modules\Parla\Models;

use App\Models\AuditModel;
use App\Modules\Parla\Enum\TipoAutor;

class Autoria extends AuditModel
{

    protected $table = 'spoa_portal_parla.autoria';
    protected $primaryKey = 'id_autoria';

    protected $fillable = [
        'id_proposicao',
        'id_parlamentar',
        'no_nome_autor',
        'in_tipo_autor',
        'sg_partido_autor',
        'sg_uf_autor',
        'tx_observacao'
    ];

    public function getInTipoAutorAttribute() {
        if($this->attributes['in_tipo_autor']) {
            return TipoAutor::getValue($this->attributes['in_tipo_autor']);
        }
    }

    public function proposicao() {
        return $this->belongsTo('App\Modules\Parla\Models\Proposicao','id_proposicao','id_proposicao');
    }

    public function parlamentar() {
        return $this->hasOne('App\Modules\Parla\Models\Parlamentar','id_parlamentar','id_parlamentar');
    }
}