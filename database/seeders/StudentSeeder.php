<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Format;
use App\Models\Job;
use App\Models\Procedure;
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

        for ($i = 0; $i <= 30; $i++) {
            $student = Student::factory()->create();
            User::factory()->create(
                [
                    'userable_type' => $student::class,
                    'userable_id' => $student->getKey(),
                ]
            );

            $ramdon = random_int(5, 15);

            for ($j = 0; $j <= $ramdon; $j++) {
                $contact = Contact::factory([
                    'student_id' => $student->getKey(),
                    'job_id' => $job->getKey(),
                ])->create();

                $company = Company::factory([
                    'student_id' => $student->getKey(),
                    'contact_id' => $contact->getKey(),
                ])->create();

                Procedure::factory([
                    'format_id' => Format::all()->random()->getKey(),
                    'status_id' => Status::all()->random()->getKey(),
                    'student_id' => $student->getKey(),
                    'company_id' => $company->getKey(),
                ])->create();
            }
        }
    }
}
