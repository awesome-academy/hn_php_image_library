<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition()
    {
        $image_id = rand(1, 5);

        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'category_id' => rand(1, 5),
            'user_id' => rand(1, 5),
            'description' => $this->faker->text(),
            'like' => rand(0, 100),
            'download' => rand(0, 100),
            'original_link' => 'images/original/' . $image_id . '.jpg',
            'thumb_link' => 'images/thumbs/' . $image_id . '.jpg',
        ];
    }
}
