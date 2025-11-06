<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'slug',
        'summary',
        'content_full',
        'hero_image',
        'tags',
        'status',
        'published_at',
        'views',
        'reading_time',
        'meta_title',
        'meta_description'
    ];

    // casts
    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
