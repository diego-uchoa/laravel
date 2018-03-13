<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Gescon\Enum\TipoEmpenho;

/**
 * Class ContratoProcessoPagamento
 * @package App\Modules\Gescon\Models
 * @version September 20, 2017, 2:29 pm UTC
 */
class ContratoProcessoPagamento extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contrato_processo_pagamento';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contrato_processo_pagamento';

    public $fillable = [
        'id_contrato',
        'nr_nota_empenho',
        'in_tipo',
        'nr_plano_interno',
        'nr_elemento_despesa'
    ];

    public function tipoEmpenho()
    {
        return TipoEmpenho::getValue($this->attributes['in_tipo']);
    }

    public function contrato(){
        return $this->belongsTo(Contrato::class, 'id_contrato', 'id_contrato');
    }

}
