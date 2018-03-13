<?php

namespace App\Modules\Prisma\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AuditModel;
use Carbon\Carbon;
use App\Modules\Prisma\Models\InstituicaoResponsavelPrevisao;
use App\Modules\Sisadm\Models\User;
use MaskHelper;

class Instituicao extends AuditModel
{
    use SoftDeletes;

    protected $table = 'spoa_portal_prisma_s1.instituicao';
    protected $primaryKey = 'id_instituicao';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nr_cnpj',
        'no_razao_social',
        'no_relatorio',
        'no_situacao',
        'nr_telefone',
        'ds_email',
        'ed_cep_logradouro',
        'ed_logradouro',
        'ed_numero_logradouro',
        'ed_complemento_logradouro',
        'ed_bairro_logradouro',
        'ed_municipio_logradouro',
        'ed_sigla_uf',
        'nr_cpf_responsavel',
        'no_responsavel',
        'nr_telefone_responsavel',
        'ds_email_responsavel',
        'no_cargo_responsavel',
        'in_situacao',
        'id_solicitacao_cadastro',
        'id_instituicao_responsavel_previsao',
        'in_situacao_prisma',
    ];

    public function getNrCpfResponsavelAttribute()
    {
        return MaskHelper::aplicaMascara($this->attributes['nr_cpf_responsavel'],'###.###.###-##');
    }

    public function usuarios() {
        return $this->belongsToMany(User::class,'spoa_portal_prisma_s1.usuario_instituicao','id_instituicao','id_usuario')->withPivot('nr_telefone','in_perfil','no_cargo');
    }

    public function editores() {
        return $this->belongsToMany(User::class,'spoa_portal_prisma_s1.usuario_instituicao','id_instituicao','id_usuario')->withPivot('nr_telefone','in_perfil','no_cargo')->where('in_perfil','E');
    }

    public function responsavel() {
        return $this->belongsToMany(User::class,'spoa_portal_prisma_s1.usuario_instituicao','id_instituicao','id_usuario')->withPivot('nr_telefone','in_perfil','no_cargo')->where('in_perfil','R');
    }

    public function instituicaoPrevisao() {
        return $this->hasOne(InstituicaoResponsavelPrevisao::class, 'id_instituicao_responsavel_previsao', 'id_instituicao_responsavel_previsao')->withTrashed();
    }

    public function getSituacaoPrismaAttribute() {
        if($this->instituicaoPrevisao && $this->responsavel->last()) {
            return 'ATIVA';
        }
        else {
            return 'INATIVA';
        }
    }
    
}
