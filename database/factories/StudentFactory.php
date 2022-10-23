<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->postcode(),
            'desire' => $this->faker->sentence(10),
            'motivation' => $this->faker->sentence(20),
            'mobility' => false,
            'promotion_id' => Promotion::all()->random(),
        ];
    }
}
