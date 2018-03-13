<?php
namespace App\Modules\Sisadm\Repositories;
use App\Modules\Sisadm\Models\ItemMenu;
use App\Repositories\AbstractRepository;
class ItemMenuRepository extends AbstractRepository
{
        public function __construct(ItemMenu $model)
        {
        $this->model = $model;
        }
        public function geraItemMenuSistema($username, $sistema)
        {
                return $this->model->query()
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
                        ->get(); 
        }
        /**
        * Recuperar todos os registros ativos dos sistemas, ordenando-os pelo nome
        * @return Array ItemMenu
        */
        public function findAllOrderByName()
        {
                $itensMenu = $this->findAll(['rota']);
                return $itensMenu;
        }   
}