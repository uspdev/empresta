<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Emprestimo;
use App\Models\Visitante;
use App\Models\Material;
use App\Models\User;
use Carbon\Carbon;

class EmprestimoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $emprestimo = [
            'data_emprestimo' => Carbon::now(),
            'visitante_id' => Visitante::factory(1)->create()[0]->id,
            'material_id' => Material::factory(1)->create()[0]->id,
            'created_by_id' => User::factory(1)->create()[0]->id,                
        ];
        Emprestimo::create($emprestimo);
        
        Emprestimo::factory(200)->create()->each(function ($emprestimo) {           
            $material = Material::factory(1)->make();
            $visitante = Visitante::factory(1)->make();
            $user = User::factory(1)->make();
            $emprestimo->material()->associate($material);
            $emprestimo->visitante()->associate($visitante);
            $emprestimo->user()->associate($user);
        });
    }
}
