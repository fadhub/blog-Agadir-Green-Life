<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tags = Tag::factory()->createMany([
            ['name' => 'recyclage'],
            ['name' => 'énergies renouvelables'],
            ['name' => 'environnement'],
            ['name' => 'agriculture bio'],
            ['name' => 'plages Agadir'],
        ]);
        // User::factory(10)->create();

        User::factory(5)->create()->each(function($user) use ($tags){
            $articles = Article::factory(3)->create([
                'user_id' => $user->id
            ]);
            $articles->each(function($article) use ($tags){
                $article->tags()->attach(
                    $tags->random(2)
                );
            });
        });
}
}
