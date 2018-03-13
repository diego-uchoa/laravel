<?php

namespace App\Modules\Parla\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoConsulta extends Model
{
	use SoftDeletes;
	
    protected $table = 'spoa_portal_parla.tipo_consulta';
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_tipo_consulta';

    protected $fillable = [
    	'tx_tipo_consulta'
    ];

}