composer create-project laravel/laravel green-agadir-blog
php artisan migrate --seed

Créer migrations + models
php artisan make:model Article -m
php artisan make:model Tag -m
php artisan make:migration create_article_tag_table --create=article_tag
Modifier migrations
 Factories
php artisan make:factory ArticleFactory --model=Article
