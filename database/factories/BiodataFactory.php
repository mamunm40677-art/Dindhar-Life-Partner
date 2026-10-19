<?php

namespace Database\Factories;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Biodata>
 */
class BiodataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'display_name' => fake()->name(),
            'gender' => fake()->randomElement(['groom', 'bride']),
            'age' => fake()->numberBetween(21, 42),
            'marital_status' => 'never_married',
            'city' => fake()->city(),
            'education' => fake()->sentence(3),
            'occupation' => fake()->jobTitle(),
            'about' => fake()->paragraph(),
            'published' => true,
        ];
    }
}
