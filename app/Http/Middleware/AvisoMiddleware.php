<?php
namespace App\Http\Middleware;

use Closure;
use Menu;
use DB;
use Auth;
use Cache;

use App\Modules\Sisadm\Models\ItemMenu;
use Illuminate\Support\Collection;

use App\Helpers\UtilHelper;

class AvisoMiddleware
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {

            $username = UtilHelper::getUsername();
            $sistema = UtilHelper::getSistema();

            if(!Cache::has('menu-avisos-usuarios-'.$sistema.'-'.$username)) {
                
                $avisoUsuario =  DB::table('spoa_portal.aviso_usuario')
                ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_usuario.id_sistema') 
                ->join('spoa_portal.usuario', 'usuario.id_usuario', '=', 'aviso_usuario.id_usuario')
                ->join('spoa_portal.tipo_aviso_usuario', 'aviso_usuario.id_tipo_aviso_usuario', '=', 'tipo_aviso_usuario.id_tipo_aviso_usuario')
                ->where('usuario.nr_cpf', $username)
                ->where('sistema.no_sistema', $sistema)
                ->select('aviso_usuario.*','sistema.no_sistema','tipo_aviso_usuario.no_tipo_aviso_usuario')
                ->orderBy('sn_lido', 'asc')
                ->orderBy('nr_ordem', 'asc')
                ->get();       

                \Debugbar::info($avisoUsuario);
                Cache::add('menu-avisos-usuarios-'.$sistema.'-'.$username,$avisoUsuario,60);
            }

            if(!Cache::has('qtd-avisos-usuarios-'.$sistema.'-'.$username)) {
                
                $qtdAviso =  DB::table('spoa_portal.aviso_usuario')
                ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_usuario.id_sistema') 
                ->join('spoa_portal.usuario', 'usuario.id_usuario', '=', 'aviso_usuario.id_usuario')
                ->where('usuario.nr_cpf', $username)
                ->where('sistema.no_sistema', $sistema)
                ->where('sn_lido', false)
                ->count();

                \Debugbar::info($qtdAviso);
                Cache::add('qtd-avisos-usuarios-'.$sistema.'-'.$username,$qtdAviso,60);
            }

            if(!Cache::has('menu-avisos-sistemas-'.$sistema)) {
                
                $avisoSistema = DB::table('spoa_portal.aviso_sistema') 
                ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_sistema.id_sistema')
                ->join('spoa_portal.tipo_aviso_sistema', 'aviso_sistema.id_tipo_aviso_sistema', '=', 'tipo_aviso_sistema.id_tipo_aviso_sistema')
                ->select('aviso_sistema.*', 'sistema.no_sistema', 'tipo_aviso_sistema.no_tipo_aviso_sistema')
                ->where('sistema.no_sistema', $sistema)
                ->where('aviso_sistema.sn_destaque', true)
                ->orderBy('nr_ordem', 'asc')
                ->get();        

                \Debugbar::info($avisoSistema);
                Cache::add('menu-avisos-sistemas-'.$sistema,$avisoSistema,60);
            } 

            if(!Cache::has('qtd-avisos-sistemas-'.$sistema)) {
                
                $qtdAviso =  DB::table('spoa_portal.aviso_sistema')
                ->join('spoa_portal.sistema', 'sistema.id_sistema', '=', 'aviso_sistema.id_sistema') 
                ->where('sistema.no_sistema', $sistema)
                ->where('sn_destaque', true)
                ->count();

                \Debugbar::info($qtdAviso);
                Cache::add('qtd-avisos-sistemas-'.$sistema,$qtdAviso,60);
            } 

                
        }

        return $next($request);
    }

}