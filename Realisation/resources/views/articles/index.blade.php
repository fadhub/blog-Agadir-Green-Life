@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Liste des Articles</h1>
        
        {{-- Filtre par catégorie --}}
        <form method="GET" action="{{ route('articles.index') }}" class="d-flex align-items-center">
            <label for="category" class="me-2 fw-semibold">Filtrer par catégorie :</label>
            <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                <option value="">Toutes</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $selectedCategory == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tableau des articles --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Catégories</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>
                            @foreach($article->categories as $cat)
                                <span class="badge bg-secondary me-1">{{ $cat->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($article->status == 'Publié')
                                <span class="badge bg-success">{{ $article->status }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $article->status }}</span>
                            @endif
                        </td>
                        <td>{{ $article->created_at->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-3">Aucun article trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $articles->appends(request()->query())->links() }}
    </div>

</div>
@endsection
