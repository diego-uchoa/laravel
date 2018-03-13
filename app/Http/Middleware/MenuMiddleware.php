<?php
namespace App\Http\Middleware;

use Closure;
use Menu;
use DB;
use Auth;
use Illuminate\Support\Facades\Cache;

use App\Modules\Sisadm\Models\ItemMenu;
use Illuminate\Support\Collection;

use App\Helpers\UtilHelper;

class MenuMiddleware
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

            if(!Cache::has('menu-'.$sistema.'-'.$username)) {
                
                $listaMenu =  DB::table('spoa_portal.item_menu')
                ->join('spoa_portal.sistema', 'item_menu.id_sistema', '=', 'sistema.id_sistema')
                ->join('spoa_portal.operacao', 'item_menu.id_operacao', '=', 'operacao.id_operacao')
                ->join('spoa_portal.perfil_operacao', 'operacao.id_operacao', '=', 'perfil_operacao.operacao_id_operacao')
                ->join('spoa_portal.perfil', 'perfil_operacao.perfil_id_perfil', '=', 'perfil.id_perfil')
                ->join('spoa_portal.usuario_perfil', 'perfil.id_perfil', '=', 'usuario_perfil.id_perfil')
                ->join('spoa_portal.usuario', 'usuario_perfil.id_usuario', '=', 'usuario.id_usuario')
                ->where('usuario.nr_cpf', '=', $username)
                ->where('sistema.no_sistema', '=', $sistema)                  
                ->select('item_menu.id_item_menu', 'item_menu.no_item_menu', 'item_menu.rota', 'item_menu.ordem', 'item_menu.icon', 'item_menu.tipo', 'item_menu.id_item_menu_precedente', 'sistema.id_sistema','sistema.no_sistema')
                ->distinct()
                ->orderBy('item_menu.ordem', 'asc')
                ->orderBy('item_menu.id_item_menu', 'asc')
                ->get();               

                //\Debugbar::info($listaMenu);
                Cache::add('menu-'.$sistema.'-'.$username,$listaMenu,60);

            }
            else {            

                $listaMenu = Cache::get('menu-'.$sistema.'-'.$username);
                //\Debugbar::info($listaMenu);
            }
            
            //Sistema sem Menu
            Menu::make('MenuSistema', function($menu) use ($listaMenu){

                foreach ($listaMenu as $item) {

                    //$menu->add($item->no_item_menu,$item->no_sistema. '/'. $item->rota);
                    if($item->id_item_menu_precedente != null){
                        $menu->add($item->no_item_menu, array('route'  => $item->rota, 'parent' => $item->id_item_menu_precedente))->id($item->id_item_menu)->data('tipo',$item->tipo);
                    }else{
                        $menu->add($item->no_item_menu, array('route'  => $item->rota))->id($item->id_item_menu)->data('icon', $item->icon)->data('tipo',$item->tipo);
                    }
                }
                
            });

        } 

        else
        {
           //Menu vazio caso alguma rota esteja utilizando esse middleware
           Menu::make('MenuSistema', function($menu) {           
           });
        }

        return $next($request);
    }

}