<?php

namespace App\Modules\Sisadm\Tests;

use Tests\BrowserKitTestCase;

class SisadmTest extends BrowserKitTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSistema()
    {
        
        $this->actingAs($this->admin)->visit('/sisadm')
        ->see($this->admin->no_usuario);

    }
}
