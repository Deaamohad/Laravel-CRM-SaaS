<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interaction>
 */
class InteractionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['call', 'email', 'meeting']),
            'notes' => fake()->paragraph(),
            'interaction_date' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
