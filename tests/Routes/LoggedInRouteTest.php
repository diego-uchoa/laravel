<?php

use Tests\BrowserKitTestCase;

/**
 * Class LoggedInRouteTest.
 */
class LoggedInRouteTest extends BrowserKitTestCase
{
    /**
     * Test the homepage works and the dashboard button appears.
     */
    public function testHomePageLoggedIn()
    {

    	$this->actingAs($this->admin)->visit('/')
    	->see($this->admin->no_usuario)
    	->see('Favoritos')
    	->see('Calendário');        
    }

    /**
    * Test the account page works and displays the users information.
    */
    
    /*
    public function testProfilePage()
    {
        //PROBLEMA COM WEBSERVICE
    	$this->actingAs($this->admin)->visit('/portal/profile')
    	->see('Dados Pessoais')
    	->see('Dados Funcionais')
    	->see('CPF')
    	->see($this->admin->no_usuario);    	
    }
    */

    /**
     * Test the logout button redirects the user back to home and the login button is again visible.
     */
    
    public function testLogoutRoute()
    {
        $this->actingAs($this->admin)->visit('/logout')->see('Informe seus dados')->see('Entrar');    	
    }   


    /**
     * Test the generic 404 page.
     */
    public function test404Page()
    {
        $response = $this->call('GET', '7g48hwbfw9eufj');
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Página não encontrada', $response->getContent());
    }
    
}

