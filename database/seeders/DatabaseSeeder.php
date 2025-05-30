<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
    // Создать 5 категорий
    Category::factory(5)->create();

    // Создать 10 тегов
    Tag::factory(10)->create();

    // Создать 10 пользователей
    $users = \App\Models\User::factory(10)->create();

    // Создать 20 постов, с привязкой к случайному пользователю и категории
    Post::factory(20)
        ->for(Category::inRandomOrder()->first())
        ->for($users->random())
        ->create()
        ->each(function ($post) use ($users) {
            // Привязать 3 комментария, каждый с случайным пользователем
            Comment::factory(3)->for($post)->for($users->random())->create();

            // Привязать случайные теги к посту
            $tags = Tag::inRandomOrder()->take(3)->pluck('id');
            $post->tags()->attach($tags);
        });
}

}
