<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'description' => fake()->bothify('?????-#####'),
            'model' => fake()->asciify('user-****'),
            //'image' => fake()->slug().'.jpg',
            'image' =>'vin'.rand(1,10).'.jpg',
            'mf_id'=>rand(35,42),
            'produced_on' => now(),
        ];
    }
}
