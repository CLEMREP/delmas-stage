<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Procedure>
 */
class ProcedureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => now(),
            'student_id' => Student::factory(),
            'company_id' => Company::factory(),
            'promotion_id' => Promotion::all()->random()->getKey(),
        ];
    }
}