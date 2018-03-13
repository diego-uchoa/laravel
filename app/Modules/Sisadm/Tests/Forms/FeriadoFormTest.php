<?php

namespace App\Modules\Sisadm\Tests\Forms;

use Tests\BrowserKitTestCase;

use App\Modules\Sisadm\Models\Feriado;

/**
 * Class FeriadoFormTest.
 */
class FeriadoFormTest extends BrowserKitTestCase
{

   
    public function testViewFeriado()
    {
        $this->actingAs($this->admin)
            ->visit('/sisadm/feriado')
            ->see('Feriado')
            ->see($this->admin->no_usuario);
    }
    
    public function testCreateFeriado()
    {
        $this->actingAs($this->admin)
            ->visit('/sisadm/feriado')
            ->click('Novo')
            ->see('Criar Novo Feriado')
            ->type('Feriado', 'no_feriado')
            ->type('01/01/2018', 'dt_feriado')
            ->press('btnFormSalvarAJAX')
            ->see('Feriado');
    }

    public function testEditFeriado()
    {
        $feriado = Feriado::first();

        $this->actingAs($this->admin)
            ->visit('/sisadm/feriado/edit/'. $feriado->id_feriado)
            ->see('success');
    }
    
    /*
    public function testUpdateFeriado()
    {

        $feriado = Feriado::first();

        $this->actingAs($this->admin)
                ->visit('/sisadm/feriado/edit/'. $feriado->id_feriado)
                ->see('Editar Feriado')
                
                //->type($feriado->id_feriado . '2', 'no_feriado')
                //->type('01/01/2018', 'dt_feriado')
                
                ->press('btnFormSalvarAJAX')
                ->see('Feriado');
    }
    */

    public function testDeleteFeriado()
    {
        $feriado = Feriado::first();

        $this->actingAs($this->admin)
           ->visit('/sisadm/feriado/destroy/'. $feriado->id_feriado)
           ->see('success');
    }

}