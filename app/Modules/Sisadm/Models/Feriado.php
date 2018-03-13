<?php

namespace App\Modules\Sisadm\Models;

use App\Models\AuditModel;
use Carbon\Carbon;

class Feriado extends AuditModel
{
    
    protected $table = 'spoa_portal.feriado';
    protected $primaryKey = 'id_feriado';

    protected $fillable= [
        'dt_feriado',
        'no_feriado',
        'sn_fim_semana'        
    ];   

    /**
 	 * Método responsável por formatar a data do feriado (dd/mm/yyyy)
     */
    public function getDtFeriadoAttribute(){
        return Carbon::parse($this->attributes['dt_feriado'])->format('d/m/Y');
    }

    /**
     * Método responsável por formatar a data do feriado para (yyyy-mm-dd)
     */
    public function setDtFeriadoAttribute($value){
        $this->attributes['dt_feriado'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    /**
     * Método responsável por formatar a data do feriado para (yyyy-mm-dd)
     */
    public function setDataFeriadoAttribute($value){
        $this->attributes['dt_feriado'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

}
