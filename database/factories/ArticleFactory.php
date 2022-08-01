<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //databdase données
            "title" => $this->faker->word(),
            "description" => $this->faker->paragraph(),
            "author_id" => Arr::random([1,2,3,4]),
            "publication_date"=> now(),
            "photo" => $this->faker->imageUrl(),
            "published" => true,
        ];
    }
}
