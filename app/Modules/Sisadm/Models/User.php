<?php

namespace App\Modules\Sisadm\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use MaskHelper;
use OwenIt\Auditing\Auditable;
use App\Notifications\enviaEmaildeDefinicaodeSenha;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use App\Modules\Gescon\Models\ContratanteUsuario;
use App\Modules\Gescon\Models\Contratante;

class User extends Authenticatable implements AuditableContract
{
    use Notifiable;
    use Auditable;
    use EntrustUserTrait {
        can as traitCan;
        hasRole as traitHasRole;
    }
    use SoftDeletes { SoftDeletes::restore insteadof EntrustUserTrait; }
    
    protected $table = 'spoa_portal.usuario';
    protected $primaryKey = 'id_usuario';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_usuario', 'email', 'nr_cpf', 'password', 'id_orgao', 'sn_ldap', 'sn_externo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNrCpfAttribute()
    {
        return MaskHelper::aplicaMascara($this->attributes['nr_cpf'],'###.###.###-##');
    }

    public function setNrCpfAttribute($value)
    {
        $value = str_replace("." , "" , $value); // remove os pontos
        $value = str_replace("-" , "" , $value); // remove o hifen

        $this->attributes['nr_cpf'] = $value;
    }

    public function perfis()
    {
        return $this->belongsToMany(Perfil::class,'spoa_portal.usuario_perfil','id_usuario','id_perfil');
    }

    public function addPerfil($perfil)
    {
        if (is_string($perfil)) {
            return $this->perfis()->save(
                Perfil::whereNoPerfil($perfil)->firstOrFail()
            );
        }

        return $this->perfis()->save(
            Perfil::whereNoPerfil($perfil->no_perfil)->firstOrFail()
        );

    }

    public function revokePerfil($perfil)
    {
        if (is_string($perfil)) {
            return $this->perfis()->detach(
                Perfil::whereName($perfil)->firstOrFail()
            );
        }

        return $this->perfis()->detach($perfil);
    }

    /**
    *Verifica se o usuário possui o perfil
    */
    public function hasPerfil($perfil)
    {
        if (is_string($perfil)) {
            return $this->perfis->contains('no_perfil', $perfil);
        }

        return $perfil->intersect($this->perfis)->count();
    }

    public function isAdmin()
    {
        return $this->hasPerfil('SISADM-Administrador');
    }

    public function isGestor()
    {
        return $this->hasPerfil('SISADM-Gestor');
    }

    public function dadosPessoais()
    {
        return $this->hasOne(SiapeDadoPessoal::class,'id_usuario','id_usuario');
    }

    public function orgao()
    {
        return $this->belongsTo(Orgao::class,'id_orgao','id_orgao');
    }

    /**
     * Método sobrescrito responsável por enviar email de redefinição de senha 
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new enviaEmaildeDefinicaodeSenha($token, $this));
    }

    
    /*
     * Método responsável por retornar todos os ContratanteUsuario do Módulo Gescon
     */
    public function contratantes()
    {
        return $this->hasMany(ContratanteUsuario::class,'id_usuario','id_usuario');
    }

    /**
     * Relacionamento com a Insituição Prisma 
     */
    public function instituicaoPrisma()
    {
        return $this->belongsToMany(\App\Modules\Prisma\Models\Instituicao::class,'spoa_portal_prisma_s1.usuario_instituicao','id_usuario','id_instituicao')->withPivot('nr_telefone','no_cargo','in_perfil');
    }
    public function getInstituicaoPrismaAttribute()
    {
        return $this->instituicaoPrisma()->first();
    }


}
