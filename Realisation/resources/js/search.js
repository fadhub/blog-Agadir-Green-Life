// Fonction de recherche en temps réel
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById("searchInput");
    const articles = document.querySelectorAll(".article-item");

    // Fonction de filtrage
    function filterArticles() {
        const query = searchInput.value.trim().toLowerCase();
        
        articles.forEach((article) => {
            const title = article.dataset.title;
            if (title.includes(query)) {
                article.style.display = "table-row";
            } else {
                article.style.display = "none";
            }
        });
    }

    // Événement de saisie
    if (searchInput) {
        // Déclenche la recherche à chaque frappe
        searchInput.addEventListener("input", filterArticles);
        
        // Déclenche la recherche au chargement de la page si le champ contient déjà une valeur
        if (searchInput.value) {
            filterArticles();
        }
    }
});
