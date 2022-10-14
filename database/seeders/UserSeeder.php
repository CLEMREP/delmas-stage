<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory()->create();

        $admin = Admin::factory()->create();
        User::factory()->create(
            [
                'userable_type' => $admin::class,
                'userable_id' => $admin->getKey(),
            ]
        );

        $teacher = Teacher::factory()->create();
        User::factory()->create(
            [
                'userable_type' => $teacher::class,
                'userable_id' => $teacher->getKey(),
            ]
        );
    }
}
