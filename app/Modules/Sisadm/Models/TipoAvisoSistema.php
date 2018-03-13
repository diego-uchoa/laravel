<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class TipoAvisoSistema extends BaseModel
{

    protected $table = 'spoa_portal.tipo_aviso_sistema';
    protected $primaryKey = 'id_tipo_aviso_sistema';

    protected $fillable= [
        'no_tipo_aviso_sistema'        
    ];

}
