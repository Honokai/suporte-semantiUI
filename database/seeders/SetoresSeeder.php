<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SetoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setores::factory()->create();
    }
}
