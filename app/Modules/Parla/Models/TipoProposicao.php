<?php

namespace App\Modules\Parla\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoProposicao extends Model
{
	use SoftDeletes;

    protected $table = 'spoa_portal_parla.tipo_proposicao';
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id_tipo_proposicao';

    protected $fillable = [
    	'sg_tipo_proposicao',
    	'tx_tipo_proposicao',
    	'sg_casa_origem',
    ];

    public function sg_casa_origem() {
        if($this->attributes['sg_casa_origem'] == 'CD') {
           return 'Câmara dos Deputados';
       }
        else if($this->attributes['sg_casa_origem'] == 'SF') {
            return 'Senado Federal';
        }
    }
}