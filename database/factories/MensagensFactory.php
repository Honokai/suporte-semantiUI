<?php

namespace Database\Factories;

use App\Models\Mensagens;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MensagensFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mensagens::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'remetente_id' => User::factory()->create()->id
        ];
    }
}
