document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const statusSelect = document.getElementById('status');
    const categorySelect = document.getElementById('category_id');
    const filterForm = document.getElementById('filter-form');
    const filterButton = document.getElementById('filter-button');

    // Fonction pour soumettre le formulaire
    function submitForm() {
        filterForm.submit();
    }

    // Écouteurs d'événements pour les champs de filtre
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(submitForm, 500); // Délai de 500ms après la fin de la frappe
        });
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', submitForm);
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', submitForm);
    }

    // Gestion du bouton de réinitialisation
    const resetButton = document.getElementById('reset-filters');
    if (resetButton) {
        resetButton.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            if (statusSelect) statusSelect.value = '';
            if (categorySelect) categorySelect.value = '';
            submitForm();
        });
    }
});
