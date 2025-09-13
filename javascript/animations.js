document.addEventListener("DOMContentLoaded", function() {
    
    // Cible tous les éléments qu'on veut animer à l'apparition
    const elementsToAnimate = document.querySelectorAll('section > *, .animal-card');

    // On ajoute une classe 'hidden' au départ pour les cacher
    elementsToAnimate.forEach(el => {
        el.classList.add('hidden');
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            // Si l'élément entre dans la vue de l'utilisateur
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    }, {
        threshold: 0.2 // L'animation se déclenche quand 20% de l'élément est visible
    });

    elementsToAnimate.forEach(el => {
        observer.observe(el);
    });
});