<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'job_id' => Job::factory()->create(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'student_id' => User::factory(),
        ];
    }
}
