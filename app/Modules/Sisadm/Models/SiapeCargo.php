<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class SiapeCargo extends BaseModel
{
    protected $table = 'spoa_portal.siape_cargo';
    protected $primaryKey = 'co_cargo';
    public $incrementing = false;

    protected $fillable= [
        'co_cargo',
        'no_cargo'
    ];   
}
