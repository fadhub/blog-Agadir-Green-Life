@props(['article' => null, 'statuses' => []])

<div class="bg-white rounded-xl shadow p-6">
    <div class="space-y-6">
        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
            <select name="status" id="status" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @foreach($statuses as $value => $label)
                    <option value="{{ $value }}" {{ old('status', $article->status ?? 'draft') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Content <span class="text-red-500">*</span></label>
            <div class="mt-1">
                <div data-hs-editor>
                    {!! old('content', $article->content ?? '') !!}
                </div>
                <textarea name="content" id="content" class="hidden" required>{{ old('content', $article->content ?? '') }}</textarea>
            </div>
            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3 pt-6">
            <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ $article ? 'Update' : 'Create' }} Article
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the editor
        const editor = document.querySelector('[data-hs-editor]');
        const textarea = document.querySelector('textarea[name="content"]');
        
        // Update the hidden textarea when the editor content changes
        editor.addEventListener('input', function() {
            textarea.value = editor.innerHTML;
        });
        
        // Initialize the editor with Preline
        if (window.HSEditor) {
            new HSEditor(editor, {
                toolbar: [
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'h1', 'h2', 'h3', 'h4', '|',
                    'unorderedList', 'orderedList', '|',
                    'link', 'image', '|',
                    'alignLeft', 'alignCenter', 'alignRight', 'alignJustify', '|',
                    'undo', 'redo'
                ]
            });
        }
    });
</script>
@endpush
