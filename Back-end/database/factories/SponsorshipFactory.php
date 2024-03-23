<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsorship>
 */
class SponsorshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
            'name' => fake() -> colorName(),
            'duration' => Carbon::instance($this->faker->dateTime())->format('H:i:s'),
            'price' => fake() -> randomFloat(2, 50, 200),
        ];
    }
}
