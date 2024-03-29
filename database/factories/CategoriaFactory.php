<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Setores;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "categoria" => $this->faker->name,
            "setor_id" => Setores::all()->random()
        ];
    }
}
