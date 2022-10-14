<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\Serie;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $series = Serie::all();
        $promotions = ['SIO1', 'SIO2', 'COM1', 'COM2', 'CI1', 'CI2', 'TOUR1', 'TOUR2'];


        foreach ($series as $key => $serie)
        {
            for ($j = $key * 2, $i = 0; $i < 2; $i++) {
                Promotion::factory()->create(['name' => $promotions[$j+$i], 'serie_id' => $serie->getKey()]);
            }
        }
    }
}
