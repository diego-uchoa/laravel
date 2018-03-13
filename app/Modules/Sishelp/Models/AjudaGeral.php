<?php

namespace App\Modules\Sishelp\Models;

use App\Models\AuditModel;

class AjudaGeral extends AuditModel
{
    
    protected $table = 'spoa_portal_sishelp.ajuda_geral';
    protected $primaryKey = 'id_ajuda_geral';

    protected $fillable= [
        'tx_ajuda_geral',     
        'id_sistema'
    ];

    public function sistema(){
        return $this->belongsTo('App\Modules\Sisadm\Models\Sistema', 'id_sistema', 'id_sistema');
    }

}
