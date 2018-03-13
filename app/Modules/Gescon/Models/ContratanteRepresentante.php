<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * Class ContratanteRepresentante
 * @package App\Modules\Gescon\Models
 * @version October 30, 2017, 2:15 pm BRST
 */
class ContratanteRepresentante extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contratante_representante';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contratante_representante';

    public $fillable = [
        'id_contratante',
        'nr_cpf_representante',
        'no_representante',
        'ds_funcao_representante',
        'nr_rg_representante',
        'dt_inicio',
        'dt_fim'
    ];

    public function getDtInicioAttribute(){
       return Carbon::parse($this->attributes['dt_inicio'])->format('d/m/Y');
    }

    public function setDtInicioAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_inicio'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_inicio'] = date('Y-m-d');
            }
        }
    }

    public function getDtFimAttribute(){
        if ($this->attributes['dt_fim']){
            return Carbon::parse($this->attributes['dt_fim'])->format('d/m/Y'); 
        }else{
            return "";
        }
    }

    public function setDtFimAttribute($value){
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_fim'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_fim'] = $value;
            }
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function contratante()
    {
        return $this->BelongsTo(Contratante::class,'id_contratante','id_contratante');
    }
}
