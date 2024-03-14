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
            'tax_id' => fake() -> randomNumber(5, true),
            'image_url' => fake() -> imageUrl(640, 480, 'projects', true),
            'biography' => fake() -> paragraph(),
            'city' => fake() -> city(),
            'phone_number' => fake() -> phoneNumber(),
            'motto' => fake() -> word(10),
        ];
    }
}
