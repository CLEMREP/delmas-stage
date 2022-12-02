<?php

namespace Database\Seeders;

use App\Models\Enums\Roles;
use App\Models\Serie;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::factory()->create([
            'email' => 'superadmin@superadmin.fr',
            'role' => Roles::SuperAdmin,
        ]);

        $superadmin->series()->attach(Serie::all());
    }
}
