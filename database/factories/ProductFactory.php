<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name'=>$this->faker->text(6),
            'description'=>$this->faker->text(20),
            'price'=>$this->faker->biasedNumberBetween(20,500),
            'quantity'=>$this->faker->biasedNumberBetween(10,30),
            'image'=>$this->faker->text='photo'.'.jpg',
            'category_id'=>$this->faker->numberBetween(1,10)
        ];
    }
}
