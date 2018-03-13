<?php

namespace App\Modules\Sismed\Models;

use App\Models\BaseModel;

class ControleProntuario extends BaseModel
{
    
    protected $table = 'spoa_portal_sismed.controle_prontuario';
    protected $primaryKey = 'in_letra_prontuario';
    public $incrementing = false;

    protected $fillable= [
        'nr_prontuario',
        'in_letra_prontuario'        
    ];

}
