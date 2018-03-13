<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Edificio
 * @package App\Modules\Gescon\Models
 * @version November 20, 2017, 8:54 am BRST
 */
class Edificio extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.edificio';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_edificio';

    public $fillable = [
        'co_edificio',
        'no_edificio',
        'sg_uf'
    ];

}
