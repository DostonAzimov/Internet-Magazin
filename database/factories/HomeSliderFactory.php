<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HomeSlider>
 */
class HomeSliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text(5),
            'subtitle'=>$this->faker->text(10),
            'price'=>$this->faker->text(8),
            'link'=>$this->faker->text(8),
            'status'=>'1',
            'image'=>'photo.jpg',
        ];
    }
}
