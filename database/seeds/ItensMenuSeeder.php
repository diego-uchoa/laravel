<?php

use Illuminate\Database\Seeder;

class ItensMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $menu1 = factory(\App\Modules\SISADM\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Tabelas Usuários',
            'rota' => 'sisadm::inicio',
            'ordem' => '10',
            'icon' => 'menu-icon glyphicon glyphicon-user',
            'tipo' => 'raiz',
            'id_sistema' => '1',
            'id_grupo_operacao' => '1'
        ]);
        $menu2 = factory(\App\Modules\SISADM\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Usuários',
            'rota' => 'sisadm::usuarios.index',
            'ordem' => '101',
            'tipo' => 'submenu',
            'id_sistema' => '1',
            'id_grupo_operacao' => '1',
            'id_item_menu_precedente' => '1'
        ]); 
        $menu3 = factory(\App\Modules\SISADM\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Perfis',
            'rota' => 'sisadm::perfis.index',
            'ordem' => '102',
            'tipo' => 'submenu',
            'id_sistema' => '1',
            'id_grupo_operacao' => '1',
            'id_item_menu_precedente' => '1'
        ]); 
        $menu4 = factory(\App\Modules\SISADM\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Tabelas Portal',
            'rota' => 'sisadm::inicio',
            'ordem' => '20',
            'icon' => 'menu-icon glyphicon glyphicon-list-alt',
            'tipo' => 'raiz',
            'id_sistema' => '1',
            'id_grupo_operacao' => '1'
        ]); 
        $menu5 = factory(\App\Modules\SISADM\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Manter Sistemas',
            'rota' => 'sisadm::sistemas.index',
            'ordem' => '204',
            'tipo' => 'submenu',
            'id_sistema' => '1',
            'id_grupo_operacao' => '1',
            'id_item_menu_precedente' => '4'
        ]);
        $menu6 = factory(\App\Modules\SISADM\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Manter Operações',
            'rota' => 'sisadm::operacoes.index',
            'ordem' => '203',
            'tipo' => 'submenu',
            'id_sistema' => '1',
            'id_grupo_operacao' => '1',
            'id_item_menu_precedente' => '4'
        ]);
        $menu7 = factory(\App\Modules\SISADM\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Manter Grupos Operações',
            'rota' => 'sisadm::grupos_operacoes.index',
            'ordem' => '202',
            'tipo' => 'submenu',
            'id_sistema' => '1',
            'id_grupo_operacao' => '1',
            'id_item_menu_precedente' => '4'
        ]);
        $menu8 = factory(\App\Modules\SISADM\Models\ItemMenu::class)->create([
            'no_item_menu' => 'Manter Itens de Menu',
            'rota' => 'sisadm::itens_menu.index',
            'ordem' => '201',
            'tipo' => 'submenu',
            'id_sistema' => '1',
            'id_grupo_operacao' => '1',
            'id_item_menu_precedente' => '4'
        ]);

    }
}
