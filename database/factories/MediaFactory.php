<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition()
    {
        return [
            'post_id' => \App\Models\Post::factory(),
            'path' => 'posts/' . $this->faker->numberBetween(1, 20) . '/image' . $this->faker->numberBetween(1, 3) . '.jpg',
            'type' => 'image/jpeg',
        ];
    }
}