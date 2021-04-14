<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;
use App\Models\User;

class MaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ativo' => 1,
            'codigo' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'descricao' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'categoria_id' => Categoria::factory(1)->create(),
            'created_by_id' => User::factory(1)->create(),
        ];
    }
}
