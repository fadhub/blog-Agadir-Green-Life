<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
    <!-- Preline CSS -->
    <link href="https://cdn.jsdelivr.net/npm/preline@2.0.0/dist/preline.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Preline Editor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@preline/editor@1.0.0/dist/hs-editor.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- En-tête -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="{{ route('admin.articles.index') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Modifier l'article</h1>
            </div>
            <p class="mt-2 text-sm text-gray-600">Mettez à jour les détails de l'article ci-dessous.</p>
        </div>

        <!-- Formulaire -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" class="space-y-6 p-6">
                @csrf
                @method('PUT')
                
                <!-- Titre -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre de l'article <span class="text-red-500">*</span></label>
                    <div class="mt-1">
                        <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Statut -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Statut <span class="text-red-500">*</span></label>
                    <div class="mt-1">
                        <select id="status" name="status" required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="">Sélectionnez un statut</option>
                            @foreach($statuses as $value => $label)
                                <option value="{{ $value }}" {{ old('status', $article->status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contenu avec Tiptap Editor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contenu <span class="text-red-500">*</span></label>
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <div id="hs-editor-tiptap">
                            <div class="sticky top-0 bg-white flex align-middle gap-x-0.5 border-b border-gray-200 p-2">
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-bold="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 12a4 4 0 0 0 0-8H6v8"></path>
                                        <path d="M15 20a4 4 0 0 0 0-8H6v8Z"></path>
                                    </svg>
                                </button>
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-italic="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="19" x2="10" y1="4" y2="4"></line>
                                        <line x1="14" x2="5" y1="20" y2="20"></line>
                                        <line x1="15" x2="9" y1="4" y2="20"></line>
                                    </svg>
                                </button>
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-underline="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 4v6a6 6 0 0 0 12 0V4"></path>
                                        <line x1="4" x2="20" y1="20" y2="20"></line>
                                    </svg>
                                </button>
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-strike="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 4H9a3 3 0 0 0-2.83 4"></path>
                                        <path d="M14 12a4 4 0 0 1 0 8H6"></path>
                                        <line x1="4" x2="20" y1="12" y2="12"></line>
                                    </svg>
                                </button>
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-link="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                    </svg>
                                </button>
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ol="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="10" x2="21" y1="6" y2="6"></line>
                                        <line x1="10" x2="21" y1="12" y2="12"></line>
                                        <line x1="10" x2="21" y1="18" y2="18"></line>
                                        <path d="M4 6h1v4"></path>
                                        <path d="M4 10h2"></path>
                                        <path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"></path>
                                    </svg>
                                </button>
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ul="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="8" x2="21" y1="6" y2="6"></line>
                                        <line x1="8" x2="21" y1="12" y2="12"></line>
                                        <line x1="8" x2="21" y1="18" y2="18"></line>
                                        <line x1="3" x2="3.01" y1="6" y2="6"></line>
                                        <line x1="3" x2="3.01" y1="12" y2="12"></line>
                                        <line x1="3" x2="3.01" y1="18" y2="18"></line>
                                    </svg>
                                </button>
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-blockquote="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 6H3"></path>
                                        <path d="M21 12H8"></path>
                                        <path d="M21 18H8"></path>
                                        <path d="M3 12v6"></path>
                                    </svg>
                                </button>
                                <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-code="">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 16 4-4-4-4"></path>
                                        <path d="m6 8-4 4 4 4"></path>
                                        <path d="m14.5 4-5 16"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="h-96 overflow-auto p-4" data-hs-editor-field="">{{ old('content', $article->content) }}</div>
                        </div>
                    </div>
                    <textarea name="content" id="content" class="hidden">{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <button type="button" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) { document.getElementById('delete-form').submit(); }" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Supprimer
                    </button>
                    <div class="space-x-3">
                        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Mettre à jour l'article
                        </button>
                    </div>
                </div>
            </form>

            <!-- Formulaire de suppression -->
            <form id="delete-form" action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <!-- Preline JS -->
    <script src="https://cdn.jsdelivr.net/npm/preline@2.0.0/dist/preline.min.js"></script>
    
    <!-- Tiptap Editor JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tiptap/core@2.1.13/tiptap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tiptap/starter-kit@2.1.13/starter-kit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tiptap/extension-link@2.1.13/link.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tiptap/extension-image@2.1.13/image.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer les éléments
            const editorElement = document.querySelector('#hs-editor-tiptap [data-hs-editor-field]');
            const hiddenTextarea = document.getElementById('content');
            let editor = null;

            // Initialiser l'éditeur Tiptap
            const initEditor = async () => {
                const { Editor } = await import('https://cdn.jsdelivr.net/npm/@tiptap/core@2.1.13/dist/tiptap.min.js');
                const { StarterKit } = await import('https://cdn.jsdelivr.net/npm/@tiptap/starter-kit@2.1.13/dist/starter-kit.min.js');
                const { Link } = await import('https://cdn.jsdelivr.net/npm/@tiptap/extension-link@2.1.13/dist/link.min.js');
                const { Image } = await import('https://cdn.jsdelivr.net/npm/@tiptap/extension-image@2.1.13/dist/image.min.js');

                editor = new Editor({
                    element: editorElement,
                    extensions: [
                        StarterKit,
                        Link.configure({
                            openOnClick: false,
                        }),
                        Image
                    ],
                    content: hiddenTextarea.value,
                    onUpdate: ({ editor }) => {
                        hiddenTextarea.value = editor.getHTML();
                    },
                });

                // Gérer les boutons de la barre d'outils
                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-bold]').forEach(button => {
                    button.addEventListener('click', () => editor.chain().focus().toggleBold().run());
                });

                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-italic]').forEach(button => {
                    button.addEventListener('click', () => editor.chain().focus().toggleItalic().run());
                });

                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-underline]').forEach(button => {
                    button.addEventListener('click', () => editor.chain().focus().toggleUnderline().run());
                });

                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-strike]').forEach(button => {
                    button.addEventListener('click', () => editor.chain().focus().toggleStrike().run());
                });

                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-link]').forEach(button => {
                    button.addEventListener('click', () => {
                        const previousUrl = editor.getAttributes('link').href;
                        const url = window.prompt('URL', previousUrl);

                        if (url === null) return;
                        if (url === '') {
                            editor.chain().focus().extendMarkRange('link').unsetLink().run();
                            return;
                        }

                        editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
                    });
                });

                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-ol]').forEach(button => {
                    button.addEventListener('click', () => editor.chain().focus().toggleOrderedList().run());
                });

                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-ul]').forEach(button => {
                    button.addEventListener('click', () => editor.chain().focus().toggleBulletList().run());
                });

                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-blockquote]').forEach(button => {
                    button.addEventListener('click', () => editor.chain().focus().toggleBlockquote().run());
                });

                document.querySelectorAll('#hs-editor-tiptap [data-hs-editor-code]').forEach(button => {
                    button.addEventListener('click', () => editor.chain().focus().toggleCodeBlock().run());
                });

                // Mettre à jour le textarea avant la soumission du formulaire
                document.querySelector('form').addEventListener('submit', () => {
                    hiddenTextarea.value = editor.getHTML();
                });
            };

            // Initialiser l'éditeur
            initEditor().catch(console.error);

            // Gérer le rechargement de la page
            window.addEventListener('beforeunload', () => {
                if (editor) {
                    hiddenTextarea.value = editor.getHTML();
                }
            });
        });
    </script>
</body>
</html>
