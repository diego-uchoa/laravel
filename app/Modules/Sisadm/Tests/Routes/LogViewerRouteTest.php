<?php

namespace App\Modules\Sisadm\Tests\Routes;

use Tests\BrowserKitTestCase;

/**
 * Class LogViewerRouteTest.
 */
class LogViewerRouteTest extends BrowserKitTestCase
{

    public function testLogViewerDashboard()
    {
        $this->actingAs($this->admin)
            ->visit('/sisadm/log-viewer')
            ->see('Dashboard');
    }
    
    public function testLogViewerList()
    {
        $this->actingAs($this->admin)
            ->visit('/sisadm/log-viewer/logs')
            ->see('Logs');
    }
    
    public function testLogViewerSingle()
    {
        $this->actingAs($this->admin)
            ->visit('/sisadm/log-viewer/logs/'.date('Y-m-d'))
            ->see('Log ['.date('Y-m-d').']');
    }
    
    public function testLogViewerSingleType()
    {
        $this->actingAs($this->admin)
             ->visit('/sisadm/log-viewer/logs/'.date('Y-m-d').'/error')
             ->see('Log ['.date('Y-m-d').']');
    }

}