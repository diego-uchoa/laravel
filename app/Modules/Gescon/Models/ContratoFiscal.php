<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Gescon\Enum\TipoFiscal;
use App\Helpers\UtilHelper;
use Carbon\Carbon;
use MaskHelper;

/**
 * Class Fiscal
 * @package App\Modules\Gescon\Models
 * @version November 20, 2017, 8:54 am BRST
 */
class ContratoFiscal extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contrato_fiscal';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contrato_fiscal';

    public $fillable = [
        'id_contrato',
        'id_fiscal_titular',
        'id_fiscal_substituto',
        'in_tipo',
        'nr_portaria',
        'nr_boletim',
        'dt_execucao',
        'tx_arquivo_ebps',
    ];

    public function getDtExecucaoAttribute(){
       return Carbon::parse($this->attributes['dt_execucao'])->format('d/m/Y');
    }

    public function setDtExecucaoAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_execucao'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_execucao'] = date('Y-m-d');
            }
        }
    }

    public function setNrPortariaAttribute($value){
        $nr_portaria = str_replace("/", "", $value);
        return $this->attributes['nr_portaria'] = $nr_portaria;
    }

    public function getNrPortariaAttribute(){
        return MaskHelper::aplicaMascara($this->attributes['nr_portaria'],'###/####');    
    }

    public function setNrBoletimAttribute($value){
        $nr_boletim = str_replace("/", "", $value);
        return $this->attributes['nr_boletim'] = $nr_boletim;
    }

    public function getNrBoletimAttribute(){
        return MaskHelper::aplicaMascara($this->attributes['nr_boletim'],'###/####');    
    }

    public function fiscalTitular(){
        return $this->hasOne(Fiscal::class, 'id_fiscal', 'id_fiscal_titular');
    }

    public function fiscalSubstituto(){
        return $this->hasOne(Fiscal::class, 'id_fiscal', 'id_fiscal_substituto');
    }

    public function tipoFiscal()
    {
        return TipoFiscal::getValue($this->attributes['in_tipo']);
    }
}
