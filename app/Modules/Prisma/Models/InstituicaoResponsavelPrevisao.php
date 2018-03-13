<?php

namespace App\Modules\Prisma\Models;

use App\Models\AuditModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InstituicaoResponsavelPrevisao
 * @package App\Modules\Prisma\Models
 * @version February 7, 2018, 4:12 pm BRST
 */
class InstituicaoResponsavelPrevisao extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_prisma_s1.instituicao_responsavel_previsao';
    protected $primaryKey = 'id_instituicao_responsavel_previsao';
    protected $dates = ['deleted_at'];

    public $fillable = [
        'no_instituicao_responsavel_previsao'
    ];

    public function instituicao() {
        return $this->hasOne(Instituicao::class, 'id_instituicao_responsavel_previsao', 'id_instituicao_responsavel_previsao')->withTrashed();
    }

    public function solicitacaoCadastro() {
        return $this->hasOne(SolicitacaoCadastro::class, 'id_instituicao_responsavel_previsao', 'id_instituicao_responsavel_previsao')->withTrashed();
    }
    
}
