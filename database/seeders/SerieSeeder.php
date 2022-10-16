<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $series = ['SIO', 'COM', 'CI', 'TOUR'];

        foreach ($series as $serie) {
            Serie::factory()->create(['name' => $serie]);
        }
    }
}
