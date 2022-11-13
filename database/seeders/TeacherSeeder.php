<?php

namespace Database\Seeders;

use App\Models\Enums\Roles;
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
        $teacher = User::factory()->create(
            [
                'email' => 'prof@prof.fr',
                'role' => Roles::Teacher,
            ]
        );

        $teacher->promotions()->attach(Promotion::find(1));
        $teacher->promotions()->attach(Promotion::find(4));
    }
}
