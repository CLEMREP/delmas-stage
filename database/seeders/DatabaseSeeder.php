<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
