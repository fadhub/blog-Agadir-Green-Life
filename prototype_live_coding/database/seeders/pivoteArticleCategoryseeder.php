<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;

class PivoteArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesId = Category::pluck('id');
        
        Article::all()->each(function($article) use ($categoriesId) {
            $article->categories()->sync(
                $categoriesId->random(rand(1, 4))->all()
            );
        });
    }
}