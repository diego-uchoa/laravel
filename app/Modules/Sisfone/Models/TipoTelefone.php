<?php

namespace App\Modules\Sisfone\Models;

use App\Models\AuditModel;

class TipoTelefone extends AuditModel
{
    
    protected $table = 'spoa_portal_sisfone.tipo_telefone';
    protected $primaryKey = 'id_tipo_telefone';

    protected $fillable= [
        'no_tipo_telefone'        
    ];

    public function telefones(){
        return $this->hasMany('App\Modules\Sisfone\Models\Telefone','id_tipo_telefone', 'id_tipo_telefone');
    }

}
