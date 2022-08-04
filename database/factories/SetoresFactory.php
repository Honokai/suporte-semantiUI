<?php

namespace Database\Factories;

use App\Models\Setores;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetoresFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setores::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $setores = collect([
            'Recursos Humanos',
            'Midia e comunicacao',
            'Tecnologia da informação'
        ]);

        return [
            'nome' => $setores->random()
        ];
    }
}
