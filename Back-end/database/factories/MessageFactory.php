<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email_title' => fake() -> word(),
            'user_email' => fake() -> safeEmail(),
            'description' => fake() -> paragraph(),
            'date_of_message' => fake() -> dateTimeBetween('-1 year', 'now'),
            'user_name' => fake() -> name(),
        ];
    }
}
