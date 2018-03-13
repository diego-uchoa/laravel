<?php

namespace App\Modules\Parla\Models;

use App\Models\AuditModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * Class RespostaMf
 * @package App\Modules\Parla\Models
 * @version August 17, 2017, 6:35 pm UTC
 */
class RespostaMf extends Model
{
    use SoftDeletes;
    protected $table = 'spoa_portal_parla.resposta_mf';
    

    protected $primaryKey = 'id_resposta_mf';
    protected $dates = ['deleted_at'];

    public $fillable = [
        'id_proposicao',
        'dt_envio',
        'id_tipo_posicao',
        'id_orgao',
        'no_documento',
        'tx_descricao',
         'tx_arquivo',   
    ];

    protected $touches = ['proposicao'];

    /**
     * Os atributos que devem ser moldados para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'id_resposta_mf' => 'integer',
        'id_proposicao' => 'integer',
        'dt_envio' => 'date',
        'id_tipo_posicao' => 'integer',
        'id_orgao' => 'integer',
        'no_documento' => 'string',
        'tx_descricao' => 'string',
        'tx_arquivo' => 'string'
    ];

    /**
     * Regras de Validação
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getDtEnvioAttribute(){
        return Carbon::parse($this->attributes['dt_envio'])->format('d/m/Y');
    }

    public function setDtEnvioAttribute($value){
        $this->attributes['dt_envio'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orgao()
    {
        return $this->belongsTo(\App\Modules\Sisadm\Models\Orgao::class,'id_orgao','id_orgao')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoPosicao()
    {
        return $this->belongsTo(\App\Modules\Parla\Models\TipoPosicao::class,'id_tipo_posicao','id_tipo_posicao')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function proposicao()
    {
        return $this->belongsTo(\App\Modules\Parla\Models\Proposicao::class,'id_proposicao','id_proposicao');
    }
}
