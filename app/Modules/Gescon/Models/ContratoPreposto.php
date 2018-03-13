<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\UtilHelper;
use Carbon\Carbon;

/**
 * Class Preposto
 * @package App\Modules\Gescon\Models
 * @version November 20, 2017, 8:54 am BRST
 */
class ContratoPreposto extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contrato_preposto';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contrato_preposto';

    public $fillable = [
        'id_contrato',
        'no_preposto',
        'nr_telefone_preposto',
        'ds_email_preposto'
    ];

}
