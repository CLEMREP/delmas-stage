<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $admin = Admin::factory()->create();
        User::factory()->create(
            [
                'email' => 'admin@admin.fr',
                'userable_type' => $admin::class,
                'userable_id' => $admin->getKey(),
            ]
        );
    }
}
