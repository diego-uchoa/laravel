<?php

namespace App\Modules\Sisadm\Models;

use App\Models\AuditModel;

class AvisoUsuario extends AuditModel
{
    
    protected $table = 'spoa_portal.aviso_usuario';
    protected $primaryKey = 'id_aviso_usuario';

    protected $fillable= [
        'tx_aviso_usuario',
        'nr_ordem',
        'id_tipo_aviso_usuario',
        'id_usuario',
        'id_sistema',
        'sn_lido',
        'dt_lido',            
    ];

    public function setIdSistemaAttribute($id)
    {
        $this->attributes['id_sistema'] = trim($id) !== '' ? $id : null;
    }   

    public function usuario(){
    	return $this->belongsTo('App\Modules\Sisadm\Models\User', 'id_usuario', 'id_usuario');
    }

    public function sistema(){
        return $this->belongsTo('App\Modules\Sisadm\Models\Sistema', 'id_sistema', 'id_sistema');
    }

    public function tipo(){
        return $this->belongsTo('App\Modules\Sisadm\Models\TipoAvisoUsuario','id_tipo_aviso_usuario','id_tipo_aviso_usuario');
    }

}
