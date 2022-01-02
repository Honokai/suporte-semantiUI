<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Categoria::factory(10)->create();
        \App\Models\Localizacao::factory(10)->create();
        // \App\Models\::factory(10)->create();
        // $this->call([
        //     SetoresSeeder::class
        // ]);
    }
}
