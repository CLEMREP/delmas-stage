<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher = Teacher::factory()->create();
        User::factory()->create(
            [
                'userable_type' => $teacher::class,
                'userable_id' => $teacher->getKey(),
            ]
        );
    }
}
