<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class Auditoria extends BaseModel
{
    
    protected $table = 'spoa_portal.audits';


    public function usuario(){
    	return $this->belongsTo('App\Modules\Sisadm\Models\User', 'user_id', 'id_usuario');
    }
    
}
