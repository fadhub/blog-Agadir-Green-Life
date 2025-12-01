<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(4);

        return [
            'author_id'=> User::inRandomOrder()->value('id') ?? 1, // بدل user_id
            'title'=> $title,
            'slug'=> Str::slug($title),
            'excerpt'=> fake()->sentence(12), // صحح excrept → excerpt
            'content'=> fake()->paragraphs(3, true),
            'status' => fake()->randomElement([
                \App\Models\Article::STATUS_DRAFT,
                \App\Models\Article::STATUS_BROUILLON
            ]),
        ];
    }
}
