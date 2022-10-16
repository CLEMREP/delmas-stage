<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formats = ['E-Mail', 'Téléphone', 'Locaux', 'Autres'];

        foreach ($formats as $format) {
            Format::insert([
                'name' => $format,
            ]);
        }
    }
}
