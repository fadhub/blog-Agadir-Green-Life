<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status',
        'author_id'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public const STATUS_DRAFT = 'draft';
    public const STATUS_BROUILLON = 'brouillon';

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }
}
