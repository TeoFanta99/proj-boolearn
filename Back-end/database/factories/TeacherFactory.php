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
        $phoneNumber = fake()->numerify('##########');
        return [
            'tax_id' => fake()->numberBetween(11111111111, 99999999999),
            'image_url' => fake()->imageUrl(640, 480, 'teachers', true),
            'cv_url' => '',
            'biography' => fake()->paragraph(),
            'city' => fake()->city(),
            'phone_number' => $phoneNumber,
            'motto' => fake()->word(10),
        ];
    }
}
