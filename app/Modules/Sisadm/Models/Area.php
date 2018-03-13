<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class Area extends BaseModel
{
    
    protected $table = 'spoa_portal.area';
    protected $primaryKey = 'id_area';

    protected $fillable= [
        'no_area',
        'ds_area'
    ];

    public function sistemas(){
    	return $this->hasMany(Sistema::class, 'sistema','id_sistema');
    }

}
