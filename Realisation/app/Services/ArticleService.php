<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ArticleService
{
    protected int $perPage = 10;

    /**
     * Récupère tous les articles avec pagination et filtres
     */
    public function getArticles(array $filters = []): LengthAwarePaginator
    {
        return Article::with(['author', 'categories'])
            ->when(!empty($filters['search']), function (Builder $query) use ($filters) {
                $query->where('title', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('content', 'like', '%' . $filters['search'] . '%');
            })
            ->when(!empty($filters['status']), function (Builder $query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(!empty($filters['category_id']), function (Builder $query) use ($filters) {
                $query->whereHas('categories', function ($q) use ($filters) {
                    $q->where('categories.id', $filters['category_id']);
                });
            })
            ->latest()
            ->paginate($filters['per_page'] ?? $this->perPage);
    }

    /**
     * Crée un nouvel article avec l'admin comme auteur
     */
    public function createArticle(array $data): Article
    {
        return DB::transaction(function () use ($data) {
            $admin = User::where('role', 'admin')->firstOrFail();
            
            return Article::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => $data['status'] ?? Article::STATUS_DRAFT,
                'author_id' => $admin->id,
            ]);
        });
    }

    /**
     * Met à jour un article existant
     */
    public function updateArticle(Article $article, array $data): bool
    {
        return $article->update([
            'title' => $data['title'] ?? $article->title,
            'content' => $data['content'] ?? $article->content,
            'status' => $data['status'] ?? $article->status,
        ]);
    }

    /**
     * Supprime un article
     */
    public function deleteArticle(Article $article): bool
    {
        return $article->delete();
    }

    /**
     * Récupère un article par son ID
     */
    public function findArticle(int $id): ?Article
    {
        return Article::with('author')->find($id);
    }

    public function getStatuses(): array
    {
        return [
            'draft' => __('Draft'),
            'published' => __('Published'),
        ];
    }
}