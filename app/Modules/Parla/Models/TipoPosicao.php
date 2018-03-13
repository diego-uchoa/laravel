<?php

namespace App\Modules\Parla\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPosicao extends Model
{
	use SoftDeletes;

    protected $table = 'spoa_portal_parla.tipo_posicao';
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_tipo_posicao';

    protected $fillable = [
    	'tx_tipo_posicao'
    ];

}