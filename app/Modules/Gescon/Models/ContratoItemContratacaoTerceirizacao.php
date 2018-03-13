<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Sisadm\Models\Orgao;

/**
 * Class Modalidade
 * @package App\Modules\Gescon\Models
 * @version September 20, 2017, 2:29 pm UTC
 */
class ContratoItemContratacaoTerceirizacao extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contrato_item_contratacao_terceirizacao';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contrato_item_contratacao_terceirizacao';

    public $fillable = [
        'id_contrato',
        'id_orgao',
        'id_edificio',
        'id_tipo_item_contratacao',
        'id_unidade_medida_item_contratacao',
        'qt_item_contratacao',
        'vl_item_contratacao'
    ];

    public function setVlItemContratacaoAttribute($value) {
        $vl_item_contratacao = str_replace(".", "", $value);
        $vl_item_contratacao = str_replace(",", ".", $vl_item_contratacao);

        return $this->attributes['vl_item_contratacao'] = $vl_item_contratacao;
    }

    public function contrato(){
        return $this->belongsTo(Contrato::class, 'id_contrato', 'id_contrato');
    }

    public function orgao(){
        return $this->hasOne(Orgao::class, 'id_orgao', 'id_orgao');
    }

    public function edificio(){
        return $this->hasOne(Edificio::class, 'id_edificio', 'id_edificio');
    }

    public function tipoItemContratacao(){
        return $this->hasOne(TipoItemContratacao::class, 'id_tipo_item_contratacao', 'id_tipo_item_contratacao');
    }

    public function unidadeMedidaItemContratacao(){
        return $this->hasOne(UnidadeMedidaItemContratacao::class, 'id_unidade_medida_item_contratacao', 'id_unidade_medida_item_contratacao');
    }
}
