<?php

namespace App\Modules\Parla\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Parla\Enum\Situacao;

/**
 * Class TipoSituacao
 * @package App\Modules\Parla\Models
 * @version August 10, 2017, 7:46 pm UTC
 */
class TipoSituacao extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_parla.tipo_situacao';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_tipo_situacao';

    public $fillable = [
        'co_tipo_situacao',
        'tx_tipo_situacao',
        'sg_casa_situacao',
        'sg_status_situacao'
    ];

    /**
     * Os atributos que devem ser moldados para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'id_tipo_situacao' => 'integer',
        'co_tipo_situacao' => 'integer',
        'tx_tipo_situacao' => 'string',
        'sg_casa_situacao' => 'string',
        'sg_status_situacao' => 'string'
    ];

    /**
     * Regras de Validação
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function sg_casa_situacao() {
        if($this->attributes['sg_casa_situacao'] == 'CD') {
           return 'Câmara dos Deputados';
       }
        else if($this->attributes['sg_casa_situacao'] == 'SF') {
            return 'Senado Federal';
        }
    }

    public function sg_status_situacao() {
        if($this->attributes['sg_status_situacao']) {
            return Situacao::getValue($this->attributes['sg_status_situacao']);
        }
    }    
}
