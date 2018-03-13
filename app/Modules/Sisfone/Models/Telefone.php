<?php

namespace App\Modules\Sisfone\Models;

use App\Models\AuditModel;

class Telefone extends AuditModel
{
    
    protected $table = 'spoa_portal_sisfone.telefone';
    protected $primaryKey = 'id_telefone';

    protected $fillable= [
        'tx_telefone',
        'sn_principal',
        'id_tipo_telefone',
        'id_usuario'
    ];

    public function usuario(){
    	return $this->belongsTo('App\Modules\Sisadm\Models\User', 'id_usuario', 'id_usuario');
    }

    public function tipo(){
        return $this->belongsTo('App\Modules\Sisfone\Models\TipoTelefone','id_tipo_telefone','id_tipo_telefone');
    }

}
