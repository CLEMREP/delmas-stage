<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Format;
use App\Models\Job;
use App\Models\Procedure;
use App\Models\Promotion;
use App\Models\Status;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job = Job::all()->random();
        $promotions = Promotion::all();

        foreach ($promotions as $promotion)
        {
            for ($i = 0; $i <= 15; $i++) {
                $user = User::factory()->create([
                    'promotion_id' => $promotion->getKey(),
                ]);

                $ramdon = random_int(5, 8);

                for ($j = 0; $j <= $ramdon; $j++) {
                    $contact = Contact::factory([
                        'user_id' => $user->getKey(),
                        'job_id' => $job->getKey(),
                    ])->create();

                    $company = Company::factory([
                        'user_id' => $user->getKey(),
                        'contact_id' => $contact->getKey(),
                    ])->create();

                    Procedure::factory([
                        'format_id' => Format::all()->random()->getKey(),
                        'status_id' => Status::all()->random()->getKey(),
                        'user_id' => $user->getKey(),
                        'company_id' => $company->getKey(),
                        'promotion_id' => $promotion->getKey(),
                        'date' => now()->subDays(random_int(1, 30)),
                    ])->create();
                }
            }
        }

        User::find(3)->update([
            'firstname' => 'Clément',
            'lastname' => 'REPEL',
            'email' => 'etudiant@etudiant.fr',
            ]
        );
    }
}
