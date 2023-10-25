<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Municipality;
use App\Models\EstablishmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Establishment>
 */
class EstablishmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->sentence(1),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'zone_type' => $this->faker->randomElement(['Urbana', 'Rural']),
            'address' => $this->faker->word(30),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'municipality_id' => function () {
                return Municipality::inRandomOrder()->first()->id;
            },
            'establishment_type_id' => function () {
                return EstablishmentType::inRandomOrder()->first()->id;
            }
        ];
    }
}
