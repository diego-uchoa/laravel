<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class TipoAvisoUsuario extends BaseModel
{
    
    protected $table = 'spoa_portal.tipo_aviso_usuario';
    protected $primaryKey = 'id_tipo_aviso_usuario';

    protected $fillable= [
        'no_tipo_aviso_usuario'        
    ];

}
