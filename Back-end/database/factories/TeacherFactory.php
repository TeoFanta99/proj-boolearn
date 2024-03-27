<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
use Faker\Factory as FakerFactory;
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = FakerFactory::create('it_IT');
        $phoneNumber = fake()->numerify('##########');
        return [
            'tax_id' => fake()->numberBetween(11111111111, 99999999999),
            'image_url' => fake()->imageUrl(640, 480, 'teachers', true),
            'cv_url' => '',
            'biography' => $faker->text(),
            'phone_number' => $phoneNumber,
            'motto' => fake()->word(10),
        ];
    }
}
