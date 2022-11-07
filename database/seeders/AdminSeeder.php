<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Enums\Roles;
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
        User::factory()->create(
            [
                'email' => 'admin@admin.fr',
                'role' => Roles::Admin,
            ]
        );
    }
}
