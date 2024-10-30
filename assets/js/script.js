
console.log ('scripts.js load');

// Gestion longueur h2 sur single_photographies
document.addEventListener('DOMContentLoaded', () => {
    const titleDescription = document.querySelector('.description > h2');  

    if (titleDescription) {
        // Vérifier la longueur du textContent
        if (titleDescription.textContent.length >= 18) {
            // Modifier la règle CSS
            titleDescription.style.maxWidth = '100%';
        } 
    }
})
