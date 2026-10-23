<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UsuarioCrudTest extends DuskTestCase
{

    public function test_Usuario(): void
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
            $username = 'usuario_teste_';

            $browser->visit('/users/create')
                ->type('name', 'Usuario Teste')
                ->type('username', $username)
                ->type('password', 'senha_teste')
                ->press('Enviar')
                ->waitForText('Usuario Teste', 15)
                ->assertSee('Usuario Teste');
            
            // Read
            $user = User::where('username', $username)->firstOrFail();
            $browser->visit("/users/{$user->id}")
                ->waitForText('Usuario Teste', 15)
                ->assertSee('Usuario Teste');
            
            // Update
            $browser->visit("/users/{$user->id}/edit")
                ->waitForText('Edição de Usuário', 15)
                ->assertSee('Edição de Usuário')
                ->type('name', 'Usuario Teste Editado')
                ->type('password', 'senha_teste_atualizada')
                ->press('Enviar')
                ->waitForText('Usuario Teste Editado', 15)
                ->assertSee('Usuario Teste Editado');

            // Delete
            $browser->visit('/users')
                ->click("form[action$='users/{$user->id}'] button[type='submit']")
                ->acceptDialog()
                ->waitUntilMissingText('Usuario Teste Editado', 15)
                ->assertDontSee('Usuario Teste Editado');
        });
    }
}