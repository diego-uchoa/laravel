<?php

namespace App\Modules\Sishelp\Models;

use App\Models\AuditModel;

class AjudaFaq extends AuditModel
{
    
    protected $table = 'spoa_portal_sishelp.ajuda_faq';
    protected $primaryKey = 'id_ajuda_faq';

    protected $fillable= [
        'tx_pergunta',
        'tx_resposta',        
        'id_sistema'
    ];

    public function sistema(){
        return $this->belongsTo('App\Modules\Sisadm\Models\Sistema', 'id_sistema', 'id_sistema');
    }

}
