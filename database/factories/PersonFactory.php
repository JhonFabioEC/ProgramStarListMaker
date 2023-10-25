<?php

namespace Database\Factories;

use App\Models\DocumentType;
use App\Models\Municipality;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $this->faker->dateTimeBetween('-30 years', 'now')->format('Y-m-d'),
            'sex' => $this->faker->randomElement(['M', 'F']),
            'document_number' => $this->faker->unique()->numerify('#############'),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'zone_type' => $this->faker->randomElement(['Urbana', 'Rural']),
            'address' => $this->faker->address(),
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'document_type_id' => function () {
                return DocumentType::inRandomOrder()->first()->id;
            },
            'municipality_id' => function () {
                return Municipality::inRandomOrder()->first()->id;
            }
        ];
    }
}
