<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    protected $table = 'mf.uf';
    protected $primaryKey = 'id_uf';

    protected $fillable= [
        'sg_uf',
        'no_uf'
    ];

    public function municipios() {
        return $this->hasMany(Municipio::class,'id_uf','id_uf');
    }
}
