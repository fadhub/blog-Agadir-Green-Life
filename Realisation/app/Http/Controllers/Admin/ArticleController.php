<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $articles = $this->articleService->getAllArticles([
            'search' => $request->input('search'),
            'status' => $request->input('status'),
            'per_page' => 10,
        ]);

        return view('admin.articles.index', [
            'articles' => $articles,
            'statuses' => $this->articleService->getStatuses(),
            'filters' => [
                'search' => $request->input('search'),
                'status' => $request->input('status'),
            ],
        ]);
    }

    public function create()
    {
        return view('admin.articles.create', [
            'statuses' => $this->articleService->getStatuses(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $article = $this->articleService->createArticle($validated);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article created successfully');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
            'statuses' => $this->articleService->getStatuses(),
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $this->articleService->updateArticle($article, $validated);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article updated successfully');
    }

    public function destroy(Article $article)
    {
        $this->articleService->deleteArticle($article);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article deleted successfully');
    }
}
