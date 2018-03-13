<?php

namespace App\Modules\Sishelp\Models;

use App\Models\AuditModel;

class AjudaArquivo extends AuditModel
{
    
    protected $table = 'spoa_portal_sishelp.ajuda_arquivo';
    protected $primaryKey = 'id_ajuda_arquivo';

    protected $fillable= [
        'no_ajuda_arquivo',               
        'no_ajuda_arquivo_original', 
        'no_ajuda_arquivo_fisico',
        'id_sistema'
    ];

    public function sistema(){
    	return $this->belongsTo('App\Modules\Sisadm\Models\Sistema', 'id_sistema', 'id_sistema');
    }

}
