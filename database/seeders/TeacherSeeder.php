<?php

namespace Database\Seeders;

use App\Models\Promotion;
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
                'email' => 'prof@prof.fr',
                'userable_type' => $teacher::class,
                'userable_id' => $teacher->getKey(),
            ]
        );

        $teacher->promotions()->attach(Promotion::find(1));
        $teacher->promotions()->attach(Promotion::find(4));
    }
}
