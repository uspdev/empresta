<?php

namespace Database\Factories;

use App\Models\Emprestimo;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Visitante;
use App\Models\Material;
use App\Models\User;

class EmprestimoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emprestimo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $visitante = Visitante::factory(1)->create();
        $material = Material::factory(1)->create();
        $user = User::factory(1)->create();
        return [
            'data_emprestimo' => $this->faker->dateTime($max = 'now', $timezone = 'UTC'),
            'visitante_id' => $visitante[0]->id,
            'material_id' => $material[0]->id,
            'created_by_id' => $user[0]->id,
        ];
    }
}
