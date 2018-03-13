<?php

namespace App\Modules\Sisfone\Tests;

use Tests\BrowserKitTestCase;

class SisfoneTest extends BrowserKitTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSistema()
    {
        
        $this->actingAs($this->admin)->visit('/sisfone')
        ->see($this->admin->no_usuario);

    }
}
