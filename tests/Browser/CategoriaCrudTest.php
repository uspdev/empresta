<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Categoria;

class CategoriaCrudTest extends DuskTestCase
{

    public function test_Categoria(): void
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
            $browser->visit('/categorias/create')
                ->type('nome', 'Categoria Teste')
                ->waitFor('#vinculos_permitidos')
                ->select('#vinculos_permitidos', 'docente')
                ->select('#setores_permitidos', 'FFLCH')
                ->press('Enviar')
                ->waitForText('Categoria Teste', 15)
                ->assertSee('Categoria Teste');

            $categoria = Categoria::latest()->first();

            // Read
            $browser->visit("/categorias/{$categoria->id}")
                ->waitForText('Categoria Teste', 15)
                ->assertSee('Categoria Teste');

            // Update
            $browser->visit("/categorias/{$categoria->id}/edit")
                ->waitForText('Edição de Categoria', 15)
                ->assertSee('Edição de Categoria')
                ->type('nome', 'Categoria Teste Editada')
                ->press('Enviar')
                ->waitForText('Categoria Teste Editada', 15)
                ->assertSee('Categoria Teste Editada');

            // Delete
            $browser->visit('/categorias')
                ->click("form[action$='categorias/{$categoria->id}'] button[type='submit']")
                ->acceptDialog()
                ->waitUntilMissingText('Categoria Teste Editada', 15)
                ->assertDontSee('Categoria Teste Editada');
        });
    }
}
