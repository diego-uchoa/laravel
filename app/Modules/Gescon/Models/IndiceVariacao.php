<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fiscal
 * @package App\Modules\Gescon\Models
 * @version November 20, 2017, 8:54 am BRST
 */
class IndiceVariacao extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.indice_variacao';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_indice_variacao';

    public $fillable = [
        'sg_indice_variacao'
    ];
    
}
