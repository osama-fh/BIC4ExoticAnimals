<?php

use Illuminate\Database\Seeder;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Species::class, 10)->create();
    }
}
