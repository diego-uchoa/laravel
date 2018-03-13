<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContratanteAssinante
 * @package App\Modules\Gescon\Models
 * @version October 30, 2017, 2:15 pm BRST
 */
class ContratanteAssinante extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contratante_assinante';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contratante_assinante';

    public $fillable = [
        'id_contratante',
        'nr_cpf_assinante',
        'no_assinante',
        'ds_funcao_assinante'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function contratante()
    {
        return $this->BelongsTo(Contratante::class,'id_contratante','id_contratante');
    }
}
