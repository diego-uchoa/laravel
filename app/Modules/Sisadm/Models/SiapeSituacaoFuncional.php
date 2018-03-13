<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class SiapeSituacaoFuncional extends BaseModel
{
    protected $table = 'spoa_portal.siape_situacao_funcional';
    protected $primaryKey = 'co_situacao_funcional';
    public $incrementing = false;

    protected $fillable= [
        'co_situacao_funcional',
        'no_situacao_funcional'
    ];   
}
