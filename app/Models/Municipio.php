<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'mf.municipio';
    protected $primaryKey = 'id_municipio';

    protected $fillable= [
        'no_municipio',
        'co_municipio_ibge',
        'id_uf'
    ];

    public function uf() {
        return $this->belongsTo(Uf::class,'id_uf','id_uf');
    }

}
