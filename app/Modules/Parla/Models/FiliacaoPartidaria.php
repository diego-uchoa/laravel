<?php

namespace App\Modules\Parla\Models;

use App\Models\BaseModel;
use Carbon\Carbon;

class FiliacaoPartidaria extends BaseModel
{
    public $timestamps = false;

    protected $table = 'spoa_portal_parla.filiacao_partidaria';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable= [
        'id_parlamentar',
        'sg_partido',
        'no_partido',
        'dt_filiacao_fim'
    ];

    public function getDtFiliacaoInicioAttribute()
    {
        if($this->attributes['dt_filiacao_inicio']) {
            return Carbon::parse($this->attributes['dt_filiacao_inicio'])->format('d/m/Y');
        }
    }

    public function setDtFiliacaoInicioAttribute($value)
    {
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_filiacao_inicio'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_filiacao_inicio'] = $value;
            }
        }
    }

    public function getDtFiliacaoFimAttribute()
    {
        if($this->attributes['dt_filiacao_fim']) {
            return Carbon::parse($this->attributes['dt_filiacao_fim'])->format('d/m/Y');
        }
    }
    
    public function setDtFiliacaoFimAttribute($value)
    {
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_filiacao_fim'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_filiacao_fim'] = $value;
            }
        }
    }    

    public function filiacoes()
    {
        return $this->hasMany(FiliacaoPartidaria::class,'id_parlamentar','id_parlamentar');
    }

}
