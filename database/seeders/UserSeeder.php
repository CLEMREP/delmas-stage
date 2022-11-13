<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Enums\Roles;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'firstname' => 'Clément',
            'lastname' => 'REPEL',
            'email' => 'contact@clement-repel.fr'
        ]);
    }
}
