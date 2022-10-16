<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Directeur', 'Directeur Ressources Humaines', 'Ressources Humaines', 'Sécrétaire', 'Développeur', 'Autres'];

        foreach ($names as $name) {
            Job::factory([
                'name' => $name,
            ])->create();
        }
    }
}
