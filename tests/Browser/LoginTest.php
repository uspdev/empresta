<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Faça login usando senha única USP!')
                ->waitFor('#loginUsuario', 20)
                ->type('#loginUsuario', '1111')
                ->press('Login')
                ->assertSee('Administração')
                ->pause('3000')
                ->click('.login_logout_link')
                ->assertSee('Sistema de Empréstimo');
        });
    }
}
