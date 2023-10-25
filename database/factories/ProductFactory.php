<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        return [
            'name' => $this->faker->sentence(1),
            'price' => $this->faker->numberBetween(1000, 1000000),
            'stock' => $this->faker->numberBetween(0, 100),
            'barcode' => $this->faker->text(13),
            'section' => $this->faker->sentence(1),
            'image' => $faker->imageUrl(),
            'description' => $this->faker->text(200),
            'state' => $this->faker->boolean(),
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'brand_id' => function () {
                return Brand::inRandomOrder()->first()->id;
            },
            'establishment_id' => function () {
                return Establishment::inRandomOrder()->first()->id;
            }
        ];
    }
}
