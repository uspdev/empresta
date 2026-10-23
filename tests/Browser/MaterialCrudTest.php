<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Categoria;
use App\Models\Material;

class MaterialCrudTest extends DuskTestCase
{
    public function test_Material(): void
    {
        $this->browse(function (Browser $browser) {
            // Login
            $browser->visit('/')
                ->clickLink('Faça login usando senha única USP!');
            $browser->waitFor('#loginUsuario')
                ->type('#loginUsuario', '1111')
                ->press('Login')
                ->waitForText('Itens Emprestados');
            
            // Fazendo categoria para o material
            $browser->visit('/categorias/create')
                ->type('nome', 'Categoria Teste')
                ->waitFor('#vinculos_permitidos')
                ->select('#vinculos_permitidos', 'docente')
                ->select('#setores_permitidos', 'FFLCH')
                ->press('Enviar')
                ->waitForText('Categoria Teste', 15)
                ->assertSee('Categoria Teste');

            $categoria = Categoria::latest()->first();

            $browser->visit("/categorias/{$categoria->id}")
                ->waitForText('Categoria Teste', 15)
                ->assertSee('Categoria Teste');

            // Início Crud Material
            //Create
            $browser->visit('/materials/create')                
                ->select('categoria_id', (string) $categoria->id)
                ->type('codigo', '123456')
                ->type('descricao', 'Material Teste')
                ->press('Enviar')
                ->waitForText('Material Teste', 15)
                ->assertSee('Material Teste');

            $material = Material::latest()->first();

            // Read
            $browser->visit("/materials/{$material->id}")
                ->waitForText('Material Teste', 15)
                ->assertSee('Material Teste');

            // Update
            $browser->visit("/materials/{$material->id}/edit")
                ->waitForText('Edição de Material', 15)
                ->assertSee('Edição de Material')
                ->type('descricao', 'Material Teste Editado')
                ->press('Enviar')
                ->waitForText('Material Teste Editado', 15)
                ->assertSee('Material Teste Editado');

            // Delete
            $browser->visit('/materials')
                ->click("form[action$='materials/{$material->id}'] button[type='submit']")
                ->acceptDialog()
                ->waitUntilMissingText('Material Teste Editado', 15)
                ->assertDontSee('Material Teste Editado');

            
        });
    }
}

