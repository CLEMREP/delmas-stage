<?php

namespace Database\Seeders;

use App\Models\Enums\Roles;
use App\Models\Serie;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create(
            [
                'email' => 'admin@admin.fr',
                'role' => Roles::Admin,
            ]
        );

        $admin->series()->attach(Serie::find(1));
        $admin->series()->attach(Serie::find(2));
    }
}
