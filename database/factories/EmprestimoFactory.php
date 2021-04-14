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
        return [
            'data_emprestimo' => $this->faker->dateTime($max = 'now', $timezone = 'UTC')->format('Y-m-d H:i:s'),
            'visitante_id' => Visitante::factory(1)->create(),
            'material_id' => Material::factory(1)->create(),
            'created_by_id' => User::factory(1)->create(),
        ];
    }
}
