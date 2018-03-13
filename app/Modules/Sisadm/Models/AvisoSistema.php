<?php

namespace App\Modules\Sisadm\Models;

use App\Models\AuditModel;

class AvisoSistema extends AuditModel
{
    
    protected $table = 'spoa_portal.aviso_sistema';
    protected $primaryKey = 'id_aviso_sistema';

    protected $fillable= [
        'tx_aviso_sistema',
        'nr_ordem',
        'id_tipo_aviso_sistema',
        'id_sistema',
        'sn_destaque',
    ];

    public function sistema(){
    	return $this->belongsTo('App\Modules\Sisadm\Models\Sistema', 'id_sistema', 'id_sistema');
    }

    public function tipo(){
        return $this->belongsTo('App\Modules\Sisadm\Models\TipoAvisoSistema','id_tipo_aviso_sistema','id_tipo_aviso_sistema');
    }

}
