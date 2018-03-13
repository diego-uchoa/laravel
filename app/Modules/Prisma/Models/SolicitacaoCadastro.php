<?php

namespace App\Modules\Prisma\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AuditModel;
use Carbon\Carbon;
use App\Helpers\UtilHelper;
use App\Modules\Prisma\Enum\SituacaoSolicitacao;
use App\Modules\Prisma\Models\InstituicaoResponsavelPrevisao;
use App\Modules\Sisadm\Models\User;
use MaskHelper;

class SolicitacaoCadastro extends AuditModel
{
    use SoftDeletes;

    protected $table = 'spoa_portal_prisma_s1.solicitacao_cadastro';
    protected $primaryKey = 'id_solicitacao_cadastro';
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
        'in_situacao_solicitacao',
        'id_instituicao_responsavel_previsao',
        'tx_analise',
        'dt_analise',
        'id_usuario_analise'
    ];

    public function getNrCnpjAttribute()
    {
        return MaskHelper::aplicaMascara($this->attributes['nr_cnpj'],'##.###.###/####-##');          
    }

    public function setNrCnpjAttribute($value)
    {
        $value = str_replace("." , "" , $value); 
        $value = str_replace("-" , "" , $value);
        $value = str_replace("/" , "" , $value);

        $this->attributes['nr_cnpj'] = $value;
    }

    public function getNrCpfResponsavelAttribute()
    {
        return MaskHelper::aplicaMascara($this->attributes['nr_cpf_responsavel'],'###.###.###-##');
    }

    public function setNrCpfResponsavelAttribute($value)
    {
        $value = str_replace("." , "" , $value); 
        $value = str_replace("-" , "" , $value);
        $value = str_replace("/" , "" , $value);

        $this->attributes['nr_cpf_responsavel'] = $value;
    }

    public function setEdNumeroLogradouroAttribute($value)
    {
        $value = str_replace("." , "" , $value); 
        $value = str_replace("," , "" , $value);

        $this->attributes['ed_numero_logradouro'] = $value;
    }

    public function getDtAnaliseAttribute(){
        if($this->attributes['dt_analise']) {
            return Carbon::parse($this->attributes['dt_analise'])->format('d/m/Y');
        }
    }

    public function getUpdatedAtAttribute(){
        if($this->attributes['updated_at']) {
            return Carbon::parse($this->attributes['updated_at'])->format('d/m/Y H:i:s');
        }
    }

    public function situacao()
    {
        return SituacaoSolicitacao::getValue($this->attributes['in_situacao_solicitacao']);
    }

    public function editores()
    {
        return $this->hasMany(SolicitacaoCadastroEditor::class,'id_solicitacao_cadastro','id_solicitacao_cadastro');
    }

    public function instituicaoPrevisao() {
        return $this->hasOne(InstituicaoResponsavelPrevisao::class, 'id_instituicao_responsavel_previsao', 'id_instituicao_responsavel_previsao')->withTrashed();
    }

    public function usuarioAnalise() {
        return $this->hasOne(User::class, 'id_usuario', 'id_usuario_analise')->withTrashed();
    }
	    

}
