<?php

namespace App\Modules\Prisma\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AuditModel;
use Carbon\Carbon;
use App\Helpers\UtilHelper;
use MaskHelper;

class SolicitacaoCadastroEditor extends AuditModel
{
    use SoftDeletes;

    protected $table = 'spoa_portal_prisma_s1.solicitacao_cadastro_editor';
    protected $primaryKey = 'id_solicitacao_cadastro_editor';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nr_cpf',
        'no_editor',
        'ds_email',
        'nr_telefone',
        'id_solicitacao_cadastro'
    ];

    public function getNrCpfAttribute()
    {
        return MaskHelper::aplicaMascara($this->attributes['nr_cpf'],'###.###.###-##');
    }

    public function setNrCpfAttribute($value)
    {
        $value = str_replace("." , "" , $value); 
        $value = str_replace("-" , "" , $value);
        $value = str_replace("/" , "" , $value);

        $this->attributes['nr_cpf'] = $value;
    }

}
