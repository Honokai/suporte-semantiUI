<?php

namespace Database\Factories;

use App\Enums\StatusTipo;
use App\Models\Categoria;
use App\Models\Chamados;
use App\Models\Localizacao;
use App\Models\Setores;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChamadosFactory extends Factory
{
    use DatabaseTransactions;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chamados::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'solicitante_id' => function(){
                return User::factory()->create()->id;
            },
            'categoria_id' => function(){
                return Categoria::factory()->create()->id;
            },
            'setor_id' => function(){
                return Setores::factory()->state(['setor'=>$this->faker->name])->create()->id;
            },
            'localizacao_id' => function(){
                return Localizacao::factory()->state(['localizacao'=>$this->faker->name])->create()->id;
            },
            'status' => StatusTipo::getRandomValue()
        ];
    }
}
