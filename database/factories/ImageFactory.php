<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
            $keywords =['news-350x223-1.jpg','news-350x223-2.jpg','news-350x223-3.jpg','news-350x223-4.jpg','news-350x223-5.jpg','news-450x350-1.jpg','news-450x350-2.jpg'];
            $keyword = fake()->randomElement($keywords);

        return [
              'path' => 'assets/front/img/' . $keyword,
        ];
    }
}
