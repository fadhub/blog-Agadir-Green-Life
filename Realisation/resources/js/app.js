// resources/js/app.js
import './bootstrap';
import 'preline';


// Initialize Preline UI components
document.addEventListener('DOMContentLoaded', function() {
    // Auto-initialize all Preline components
    if (window.HSStaticMethods) {
        HSStaticMethods.autoInit();
    }

    // Initialize editor if it exists
    const editor = document.querySelector('[data-hs-editor]');
    if (editor && window.HSEditor) {
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

        // Sync editor content with hidden textarea
        editor.addEventListener('input', function() {
            const textarea = document.querySelector('textarea[name="content"]');
            if (textarea) {
                textarea.value = editor.innerHTML;
            }
        });
    }
});