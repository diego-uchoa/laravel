<?php

namespace App\Modules\Sismed\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AuditModel;
use App\Helpers\UtilHelper;
use App\Modules\Sisadm\Models\SiapeCargo;
use Carbon\Carbon;
use App\Modules\Sismed\Enum\RegimeJuridico;

class ControleCiclo extends AuditModel
{
    use SoftDeletes;
    
    protected $table = 'spoa_portal_sismed.controle_ciclo';
    protected $primaryKey = 'id_controle_ciclo';
    protected $dates = ['deleted_at'];

    protected $fillable= [
        'id_servidor',
        'id_atestado_origem',
        'dt_inicio_ciclo',
        'dt_fim_ciclo',
        'va_adicional_ciclo_anterior'
    ];

    public function getPeriodoAttribute()
    {
        return (Carbon::parse($this->attributes['dt_inicio_ciclo'])->format('d/m/Y') .' - '. Carbon::parse($this->attributes['dt_fim_ciclo'])->format('d/m/Y'));
    }

    public function atestados()
    {
        return $this->hasMany(Atestado::class,'id_controle_ciclo','id_controle_ciclo');
    }



}
