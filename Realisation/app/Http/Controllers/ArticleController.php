<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Affiche la liste des articles
     */
    public function index(Request $request): View
    {
        $filters = [
            'search' => $request->input('search'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
            'per_page' => 10
        ];

        $articles = $this->articleService->getArticles($filters);

        // Debug: Afficher les informations de débogage
        \Log::info('Articles data:', [
            'count' => $articles->count(),
            'total' => $articles->total(),
            'first_page' => $articles->items()
        ]);

        $statuses = [
            '' => 'Tous les statuts',
            Article::STATUS_DRAFT => 'Brouillon',
            Article::STATUS_BROUILLON => 'Publié'
        ];

        $categories = Category::pluck('name', 'id')->prepend('Toutes les catégories', '');
        
        return view('admin.articles.index', compact('articles', 'statuses', 'categories'));
    }

    /**
     * Affiche le formulaire de création d'un article
     */
    public function create(): View
    {
        return view('admin.articles.create', [
            'statuses' => [
                'draft' => 'Brouillon',
                'published' => 'Publié'
            ]
        ]);
    }

    /**
     * Enregistre un nouvel article
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:180',
            'content' => 'required|string',
            'status' => 'required|in:draft,published'
        ]);

        $this->articleService->createArticle($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    /**
     * Affiche un article spécifique
     */
    public function show(Article $article): View
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Affiche le formulaire d'édition d'un article
     */
    public function edit(Article $article): View
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'statuses' => [
                'draft' => 'Brouillon',
                'published' => 'Publié'
            ]
        ]);
    }

    /**
     * Met à jour un article existant
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:180',
            'content' => 'required|string',
            'status' => 'required|in:draft,published'
        ]);

        $this->articleService->updateArticle($article, $validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Supprime un article
     */
    public function destroy(Article $article): RedirectResponse
    {
        $this->articleService->deleteArticle($article);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}