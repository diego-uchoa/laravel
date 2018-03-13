<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContratoInformacaoAdicional
 * @package App\Modules\Gescon\Models
 * @version September 20, 2017, 2:29 pm UTC
 */
class ContratoInformacaoAdicional extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contrato_informacao_adicional';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contrato_informacao_adicional';

    public $fillable = [
        'id_contrato',
        'id_campo_informacao_adicional',
        'ds_campo_informacao_adicional'
    ];

    public function contrato(){
        return $this->belongsTo(Contrato::class, 'id_contrato', 'id_contrato');
    }

}
