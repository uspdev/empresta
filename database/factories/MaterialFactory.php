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
        $categoria = Categoria::factory(1)->create();
        $user = User::factory(1)->create();
        return [
            'ativo' => 1,
            'codigo' => $this->faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
            'descricao' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'categoria_id' => $categoria[0]->id,
            'created_by_id' => $user[0]->id,
        ];
    }
}
