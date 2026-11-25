<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Product> */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'user_id'       => User::factory()->productor(),
            'category'      => fake()->randomElement(['agricola', 'artesanal']),
            'name'          => fake()->words(2, true),
            'producer_name' => fake()->name(),
            'price'         => fake()->randomFloat(2, 1, 80),
            'unit'          => fake()->randomElement(['kilo', 'unidad', 'arroba']),
            'location'      => 'Feria dominical, Chinchero',
            'description'   => fake()->sentence(),
        ];
    }
}
