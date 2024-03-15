<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tax_id' => fake()->numberBetween(11111111111, 99999999999),
            'image_url' => fake()->imageUrl(640, 480, 'teachers', true),
            'cv_url' => fake()->imageUrl(640, 480, 'teachers', true),
            'biography' => fake()->paragraph(),
            'city' => fake()->city(),
            'phone_number' => fake()->phoneNumber(),
            'motto' => fake()->word(10),
        ];
    }
}
