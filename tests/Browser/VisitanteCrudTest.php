<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Visitante;

class VisitanteCrudTest extends DuskTestCase
{

    public function test_Visitante(): void
    {
        $this->browse(function (Browser $browser) {
            // Login
            $browser->visit('/')
                ->clickLink('Faça login usando senha única USP!');
            $browser->waitFor('#loginUsuario')
                ->type('#loginUsuario', '1111')
                ->press('Login')
                ->waitForText('Itens Emprestados');
            
            // Início do teste crud
            //Create
            $browser->visit('/visitantes/create')
                ->type('nome', 'Usuario Teste')
                ->type('telefone', '(11) 99999-9999')
                ->type('email', 'usuario@teste.com')
                ->press('Enviar')
                ->waitForText('Usuario Teste', 15)
                ->assertSee('Usuario Teste');

            $visitante = Visitante::latest()->first();
            
            // Read
            $browser->visit("/visitantes/{$visitante->id}")
                ->waitForText('Usuario Teste', 15)
                ->assertSee('Usuario Teste');
            
            // Update
            $browser->visit("/visitantes/{$visitante->id}/edit")
                ->waitForText('Edição de Visitante', 15)
                ->assertSee('Edição de Visitante')
                ->type('nome', 'Usuario Teste Editado')
                ->press('Enviar')
                ->waitForText('Usuario Teste Editado', 15)
                ->assertSee('Usuario Teste Editado');

            // Delete
            $browser->visit('/visitantes')
                ->click("form[action$='visitantes/{$visitante->id}'] button[type='submit']")
                ->acceptDialog()
                ->waitUntilMissingText('Usuario Teste Editado', 15)
                ->assertDontSee('Usuario Teste Editado');
        });
    }
}
